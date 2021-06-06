<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    public $timestamps = false;
    public $incrementing = false;
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

