<?php

namespace App;

class Medico
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_usuario_id', 'cns', 'cnes', 'estabelecimento'
    ];

    protected $table = "medicos";

    protected $primaryKey = "fk_usuario_id";

}

