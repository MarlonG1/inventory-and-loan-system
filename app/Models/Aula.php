<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = [
      'aula',
    ];

    public $timestamps = false;

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
