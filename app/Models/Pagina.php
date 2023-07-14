<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagina
 *
 * @property $id
 * @property $text
 * @property $numeracion
 * @property $cuento_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cuento $cuento
 * @property Ilustracion[] $ilustracions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Pagina extends Model
{
    protected $table = 'pagina';
    
   
    protected $perPage = 20;

    
    protected $fillable = ['text','numeracion','url','descripcion','cuento_id'];


    
    public function cuento()
    {
        return $this->hasOne('App\Models\Cuento', 'id', 'cuento_id');
    }
        
}
