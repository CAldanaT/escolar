<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunidades;
use Log;

class CominidadesController extends Controller
{
    public function getAll(){
        $data = Comunidades::get();

        return response()->json($data, 200);
    }

    public function create(Request $request){
        $data['name'] = $request['name'];

        Comunidades::create($data);

        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
    }
    
    public function delete($id){
        $res = Comunidades::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
    }

    public function get($id){
        $data = Comunidades::find($id);
        return response()->json($data, 200);
      }
  
      public function update(Request $request,$id){
        $data['name'] = $request['name'];
        Comunidades::find($id)->update($data);
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
      }
}
