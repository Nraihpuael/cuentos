<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuento extends Model
{
    protected $table = 'cuento';
    
    static $rules = [
		'titulo' => 'required',
        'fecha' => 'required',
		'genero_id' => 'required',
		'user_id' => 'required'
    ];

    protected $perPage = 20;


    protected $fillable = ['titulo','fecha','genero_id','user_id'];



    public function elementos()
    {
        return $this->hasMany('App\Models\Elemento', 'cuento_id', 'id');
    }
    
 
    public function genero()
    {
        return $this->hasOne('App\Models\Genero', 'id', 'genero_id');
    }
    

    public function cuentopaginas()
    {
        return $this->hasMany('App\Models\Pagina', 'cuento_id', 'id');
    }
    

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    

}