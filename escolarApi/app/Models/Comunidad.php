<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    use HasFactory;

    protected $table = 'comunidades';

    protected $fillable = ["name"];

    public function escuelas()
    {
        return $this->hasMany(Escuelas::class);
    }
}
