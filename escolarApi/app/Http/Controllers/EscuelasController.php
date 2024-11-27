<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Escuelas;
use Log;

class EscuelasController extends Controller
{
    public function getAll(){
        $data = Escuelas::get();

        return response()->json($data, 200);
    }

    public function create(Request $request){
        $data['name'] = $request['name'];
        $data['comunidad_id'] = $request['comunidad_id'];

        Escuelas::create($data);

        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
    }
    
    public function delete($id){
        $res = Escuelas::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
    }

    public function get($id){
        $data = Escuelas::find($id);
        return response()->json($data, 200);
    }
  
    public function update(Request $request,$id){
        $data['name'] = $request['name'];
        $data['comunidad_id'] = $request['comunidad_id'];
        Escuelas::find($id)->update($data);
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function getByComunidad($comunidad){
        $data = Escuelas::where('comunidad_id', $comunidad);
        return response()->json($data, 200);
    }
}
