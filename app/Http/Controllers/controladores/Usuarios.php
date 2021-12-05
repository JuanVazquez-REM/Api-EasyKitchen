<?php

namespace App\Http\Controllers\controladores;
use  Illuminate\Support\Facades\DB ;
use App\modelos\Producto;
use App\modelos\Comentario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use \Mailjet\Resources;
use App\modelos\tokens;

class Usuarios extends Controller{
    public function hola(){
        return 'hola';
    }

    public function insertarUser(Request $request){

        $request->validate([
            'nombre'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);    

        $user_email_repeat = User::Where('email', $request->email)->first();

        if($user_email_repeat){
            return response()->json([
                'message'=>'El correo ya esta registrado'
            ],400);
        }

        $User = new User;

        $User->nombre=$request->nombre;
        $User->email=$request->email;
        $User->password=Hash::make($request->password);
        
        if($User->save()){
            return response()->json([
                'message'=>'Se registro correctamente',
                'user'=>$User
            ],201);      
        }
    } 


    public function LogIn(Request $request){

        
        $user= User::where('email',$request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message'=>'Contraseña o correo incorrecta',
            ],400);
            
        }else{

            $token = $user->createToken('token')->plainTextToken;
            $user->save(); 

            return response()->json([
                'message'=>'Token registrado',
                'token'=>$token,
                'user'=>$user
            ],201);
        }
    }

    public function LogOut(Request $request){
        return response()->json(["eliminados"=>$request->user()->tokens()->delete()],200);
    }

    public function Check(Request $request){
        return $request->user();
    }

    public function usuarios(){
        return User::all();
    }

    public function actualizarUser(Request $request){
        $user_email_repeat = User::Where('email', $request->email)->Where('id','<>',$request->user()->id)->first();

        if($user_email_repeat){
            return response()->json([
                'message'=>'El correo ya esta registrado',
                'user'=>$user_email_repeat
            ],400);
        }

        $User = User::Where('id',$request->user()->id)->first();
        
        if(!empty($request->nombre)){
            $User->nombre=$request->nombre;
        }

        if(!empty($request->email)){
            $User->email=$request->email;
        }

        if($User->save()){
            return response()->json([
                'message'=>'Se actualizo correctamente',
                'user'=>$User
            ],200);      
        }  
    } 
}
