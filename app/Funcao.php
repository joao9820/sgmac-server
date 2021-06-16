<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];

    protected $table = "funcoes";

    protected $primaryKey = "id_funcao";

}

