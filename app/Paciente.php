<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{


    public $timestamps = false;
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_usuario_id', 'cns', 'peso', 'tamanho', 'nome_da_mae', 'etnia', 'raca'
    ];

    protected $table = "pacientes";

    protected $primaryKey = "fk_usuario_id";

}

