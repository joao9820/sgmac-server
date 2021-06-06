<?php

namespace App;

class Paciente
{
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

