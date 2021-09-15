<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            DB::beginTransaction();
            $cc = $request->cc;
            $valid = UserModel::where("documento", $cc)->count();
           
            //si existe el usuario 
            if ($valid == 1) {
                $user = UserModel::where("documento", $cc)->first();
                $id = $user->id;
                $count_cod_user = UserModel::where("documento", $id)->where("estado", 1)->count();
            
                //abro la session del usuario
                session(['session_usuario_id' => $user->id]); 

                DB::commit();
                return response()->json([
                    'result' => true,
                    'valid' => 1,
                    'data' => $user,
                    'count_cod_user' => $count_cod_user
                ]);
                
            } else if ($valid == 0) {
                DB::commit();
                return response()->json([
                    'result' => true,
                    'valid' => 0
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'result' => false,
                    'valid' => "Ocurrió un error, intenta más tarde"
                ]);
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'valid' => "Ocurrió un error, intenta más tarde",
            ]);
        }
    }

    public function validar_registro(Request $request)
    {
        
        try {
            DB::beginTransaction();
            $tipo_documento = $request->tipo_documento;
            $documento = $request->documento;
            $nombre = $request->nombre;
            $apellido = $request->apellido;          
            $email = $request->email;
            $telefono = $request->telefono;
            $tel_adic = $request->tel_adic;
            $dp_nombre=$request->dp_nombre;
            $ci_nombre=$request->ci_nombre;

            $val_cc = UserModel::where("documento", $documento)->count();

            if ($val_cc > 0) {
                DB::rollBack();
                return response()->json([
                    'result' => false,
                    'data' => "Esta cédula ya se encuentra registrada",
                ]);
            } else if ($val_cc == 0) {
                $data = [
                    "tipo_documento" => $tipo_documento,
                    "documento" => $documento,
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "departamento" => $dp_nombre,
                    "ciudad" => $ci_nombre,
                    "email" => $email,
                    "telefono" => $telefono,
                    "tel_adic" => $tel_adic,      
                ];
                DB::commit();
                return response()->json([
                    'result' => true,
                    'data' => "Validado para registrarse correctamente",
                    'info' => $data
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'result' => false,
                    'data' => "Ocurrió un error, intenta más tarde",
                ]);
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'data' => "Ocurrió un error, estoy en validar registro",
            ]);
        }
    }

    public function registro(Request $request)
    {
      
        try {
            DB::beginTransaction();
            $tipo_documento = $request->data["tipo_documento"];
            $documento = $request->data["documento"];
            $nombre = $request->data["nombre"];
            $apellido = $request->data["apellido"];
            $departamento = $request->data["departamento"];
            $ciudad = $request->data["ciudad"];
            $email = $request->data["email"];
            $telefono = $request->data["telefono"];
            $tel_adic = $request->data["tel_adic"];
            $origen = 0;


            // if (session("session_asesora_id")) {
            //     $origen = session("session_asesora_id");

            // }
            $validar_email = UserModel::where('email',$email)->first();
            if($validar_email){
                return response()->json([
                    'result' => false,
                    'data' => "Correo ya registrado ",
                    
                ]);
            }else{

                $id = UserModel::insertGetId([
                    'id_tipo_documento' => $tipo_documento,
                    'documento' => $documento,
                    'nombres' => $nombre,
                    'apellidos' => $apellido,
                    'id_depart' => $departamento,
                    'id_ciudad' => $ciudad,
                    'email' => $email,
                    'celular' => $telefono,
                    'tel_adic' => $tel_adic,
                    'estado' => 1,
                    'origen' => $origen
                ]);
    
                $data = UserModel::where("id", $id)->first();
    
                DB::commit();
    
                return response()->json([
                    'result' => true,
                    'data' => "Registrado correctamente",
                    'data_user' => $data
                ]);
            }

        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'data' => $ex,
            ]);
        }
    }

}
