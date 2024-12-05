<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Rol;

class RolesController extends Controller
{
    public function getAll(){
        $roles = Rol::all();

        return response()->json($roles, 200);
    }
}
