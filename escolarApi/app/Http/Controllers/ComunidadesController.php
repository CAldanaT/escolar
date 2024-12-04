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

        return response()->json($comunidad, 201);
    }
    
    public function delete($id){
        $res = Comunidad::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
    }

    public function get($id){
        $data = Comunidad::find($id);
        return response()->json($data, 200);
      }
  
      public function update(Request $request,$id){
        $validator = Validator::make(request()->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $data['name'] = $request['name'];
        Comunidad::find($id)->update($data);
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
      }
}
