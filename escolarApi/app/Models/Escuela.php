<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    protected $table = 'escuelas';

    protected $fillable = ["name", "comunidad_id"];

    public function comnunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
