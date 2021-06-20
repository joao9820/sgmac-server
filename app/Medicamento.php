<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'descricao', 'estoque_mininimo'
    ];

    protected $table = "medicamentos";

    protected $primaryKey = "id_medicamento";

}

