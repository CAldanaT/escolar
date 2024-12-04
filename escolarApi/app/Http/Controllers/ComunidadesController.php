<?php

namespace App\Http\Controllers;
use App\Models\Comunidad;
use Illuminate\Http\Request;
use Validator;

class ComunidadesController extends Controller
{
    public function getAll(){
        $data = Comunidad::all();

        return response()->json($data, 200);
    }

    public function get($id){
        $comunidad = Comunidad::find($id);

        if(!comunidad){
            $data = [
                "message" => "Comunidad no encontrada",
                "status" => 404
            ];
            return response()->json($data, 404);
        }

        return response()->json($comunidad, 200);
    }

    public function post(Request $request){

        $validator = Validator::make(request()->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $comunidad = new Comunidad();
        $comunidad->name = request()->name;
        $comunidad->save();

        if(!$comunidad){
            $data = [
                "message" => 'Error al agregar la comundiad',
                "status" => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            "comundiad" => $comunidad,
            "message" => "Comunidad agregada correctamente",
            "status" => 201
        ];

        return response()->json($data, 201);
    }
    
    public function delete($id){
        $comunidad = Comunidad::find($id);

        if(!$comunidad){
            $data = [
                "message" => "Comunidad no encontrada",
                "status" => 404
            ];

            return response()->json($data, $data->status);

        }

        $comunidad->delete();

        return response()->json([
            'message' => "Comunidad eliminada.",
            'success' => true
        ], 200);
    }

    public function put(Request $request,$id){
        $comunidad = Comunidad::find($id);

        if(!$comunidad){
            $data = [
                "message" => "Comunidad no encontrada",
                "status" => 404
            ];

            return response()->json($data, $data->status);

        }
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $comunidad->name = $request->name;
        $comunidad->update($data);

        return response()->json([
            'message' => "Comunidad Actualizada",
            'success' => true
        ], 200);
    }
}
