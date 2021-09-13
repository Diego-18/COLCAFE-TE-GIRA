<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RedencionesModel;
use App\Http\Controllers\Exception;

class RegistroEmpaquesController extends Controller
{
    public function index(){
            return view('registro-empaques');
    }

    public function registro_empa(Request $request){

        $gramos_registrados = $request->gramos;
        try{
            DB::beginTransaction();
            $id_usuario =  session('session_usuario_id');
            $id_producto = $request->producto;
            $gramaje = $request->gramaje;
        
        $array = [];
            foreach ($request->productGram as $i => $value) {
                $producgram =  $value;
                $id_producto = $producgram['productos'];
                $gramaje = $producgram['gramajes'];
                $id = RedencionesModel::insertGetId([
                    'id_usuario' => $id_usuario,
                    'id_producto' =>  $id_producto,
                    'gramaje'=> $gramaje,
                    'gramos_registrados'=>   $gramos_registrados 
                ]);
                $array[$i]= $id;
            }
            $data =[];
            foreach ($array as $i => $value) {
                $data[$i] = RedencionesModel::where('id', $value)->first();
            }
            DB::commit();
            return response()->json([
                'result' => true,
                'data' => "Registrado correctamente",
                'data_empaque' => $data
            ]);

        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json([
                'result' => false,
                'valid' => "Ocurrió un error, intenta más tarde",
            ]);
        }
        
    }
    public function ver_registro_empa(){

     

      $id_usuario =  session('session_usuario_id');
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Bogota');
            $date = date('d-m-Y - H:i A');
            $productos = RedencionesModel::select(DB::raw("producto.id,producto.producto,redenciones.gramaje,redenciones.gramos_registrados"))
                ->join("usuarios", "redenciones.id_usuario", "=", "usuarios.id")
                ->join("producto", "redenciones.id_producto","=", "producto.id")
                ->where("usuarios.id",  $id_usuario )
                ->orderBy("producto.id", "ASC")
               ->groupBy("producto.producto")
               ->groupBy('producto.id','redenciones.gramos_registrados','redenciones.gramaje')

                ->get();          
            DB::commit();

            return response()->json([
                'result' => true,
                'productos' => $productos,
                'date' => $date 
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            date_default_timezone_set('America/Bogota');
            $date = date('d-m-Y - H:i A');
            $productos = [];
            return response()->json([
                'result' => false,
                'valid' => "Ocurrió un error, intenta más tarde",
                'ex' => $ex
            ]);
        }

     
    }
}
