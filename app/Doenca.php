<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doenca extends Model
{
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'cid_10'
    ];

    protected $table = "doencas";

    protected $primaryKey = "id_doenca";

}

