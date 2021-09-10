<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RedencionesModel;

class RegistroEmpaquesController extends Controller
{
    public function index(){
            return view('registro-empaques');
    }

    public function registro_empa(Request $request){
        try{
            DB::beginTransaction();
            $id_usuario =  session('session_usuario_id');
            $id_producto = $request->producto;
            $gramaje = $request->gramaje;
            $gramos_registrados = $request->gramos;

            $id = RedencionesModel::insertGetId([
                'id_usuario' => $id_usuario,
                'id_producto' =>$id_producto,
                'gramaje'=>$gramaje,
                'gramos_registrados'=>$gramos_registrados
            ]);

            $data = RedencionesModel::where('id',$id)->first();

            DB::commit();
            return response()->json([
                'result' => true,
                'data' => "Registrado correctamente",
                'data_empaque' => $data
            ]);

        }catch(Exception $ex){
            DB::rollBack();
            return response()->json([
                'result' => false,
                'valid' => "Ocurrió un error, intenta más tarde",
            ]);
        }
        
    }
}
