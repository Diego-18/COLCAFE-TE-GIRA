<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RedencionesModel;
use App\Models\ProductosModel;
use App\Http\Controllers\Exception;
use Illuminate\Support\Facades\Http;


class RegistroEmpaquesController extends Controller
{
    public function index(){
            try{
                DB::beginTransaction();
                date_default_timezone_set('America/Bogota');
                $date = date('d-m-Y - H:i A');
                $traer_productos = ProductosModel::all();
                DB::commit();
                return view("registro-empaques", compact("traer_productos", "date"));

            }catch(\Exception $ex){
                DB::rollBack();
                date_default_timezone_set('America/Bogota');
                $date = date('d-m-Y - H:i A');
                $traer_productos = [];
                return view("registro_empaques", compact("traer_productos", "date"));
            }
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
                'valid' => "Ocurri?? un error, intenta m??s tarde",
            ]);
        }
        
    }
    public function ver_registro_empa(){
      $id_usuario =  session('session_usuario_id');
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Bogota');
            $date = date('d-m-Y - H:i A');
            $productos = RedencionesModel::select(DB::raw("producto.id,producto.producto,redenciones.id_gramaje,redenciones.gramos_registrados"))
                ->join("usuarios", "redenciones.id_usuario", "=", "usuarios.id")
                ->join("producto", "redenciones.id_producto","=", "producto.id")
                ->join("gramaje", "redenciones.id_gramaje","=", "gramaje.id")
                ->where("usuarios.id",  $id_usuario )
                ->orderBy("producto.id", "ASC")
               ->groupBy("producto.producto")
               ->groupBy('producto.id','redenciones.gramos_registrados','redenciones.id_gramaje')
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
                'valid' => "Ocurri?? un error, intenta m??s tarde",
                'ex' => $ex
            ]);
        }

     
    }

    public function all_departments(Request $request) {
        try{
            $sms = Http::acceptJson()->get("https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json");
            return $sms;
        }catch (\Exception $ex){
            return $ex;
        }
    }

    
}
