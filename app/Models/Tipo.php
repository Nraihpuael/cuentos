<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipo';

    protected $fillable = [
        'nombre'
    ];

    public function elementos()
    {
        return $this->hasMany('App\Models\Elemento');
    }
}
