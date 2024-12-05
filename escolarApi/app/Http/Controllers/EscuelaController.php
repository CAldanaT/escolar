<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Escuela;
use Validator;

class EscuelaController extends Controller
{
    public function getAll()
    {
        $escuelas = Escuela::with('comunidad')->get();

        return response()->json($escuelas, 200);
    }

    public function get($id)
    {
        $escuela = Escuela::find($id);

        return response()->json($escuela, 200);

    }

    public function post(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'comunidad_id' => 'required|exists:comunidades,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $escuela = new Escuela();
        $escuela->name = $request->name;
        $escuela->comunidad_id = $request->comunidad_id;
        $escuela->save();

        if(!$escuela){
            $data = [
                "message" => 'Error al agregar la escuela',
                "status" => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            "comundiad" => $escuela,
            "message" => "Escuela agregada correctamente",
            "status" => 201
        ];

        return response()->json($data, 201);
    }

    public function put(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'sometimes|string|max:255',
            'comunidad_id' => 'sometimes|exists:comunidades,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $escuela = Escuela::find($id);

        if(!$escuela){
            $data = [
                "message" => "Escuela no encontrada",
                "status" => 404
            ];

            return response()->json($data, $data->status);
        }

        $escuela->name = $request->name;
        $escuela->comunidad_id = $request->comunidad_id;
        $escuela->save();

        return response()->json([
            'message' => "Escuela actualizada correctamente",
            'success' => true
        ], 200);
    }

    public function delete($id)
    {
        $escuela = Escuela::find($id);

        if(!$escuela){
            $data = [
                "message" => "Escuela no encontrada",
                "status" => 404
            ];

            return response()->json($data, $data->status);

        }

        $escuela->delete();

        return response()->json([
            'message' => "Escuela eliminada.",
            'success' => true
        ], 200);
    }
}
