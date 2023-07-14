<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagina
 *
 * @property $id
 * @property $text
 * @property $cuento_id
 * @property $tipo_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cuento $cuento
 * @property Ilustracion[] $ilustracions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Elemento extends Model
{
    protected $table = 'elemento';
    
   
    protected $perPage = 20;

    
    protected $fillable = ['nombre','text','url','descripcion','cuento_id','tipo_id'];


    
    public function cuento()
    {
        return $this->hasOne('App\Models\Cuento', 'id', 'cuento_id');
    }

    public function tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'tipo_id');
    }
    
}
