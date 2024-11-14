<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuelas extends Model
{
    use HasFactory;

    protected $table = "escuelas";

    protected $fillable = [
        'name',
        'comunidad_id'
    ];

}
