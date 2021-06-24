<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_medico_id', 'fk_paciente_id', 'fk_unidade_id', 'fk_doenca_id', 'fk_autorizador_id', 'fk_status_id','observacao',
        'anamnese', 'diagnostico', 'data_inicio', 'data_fim', 
    ];

    protected $table = "solicitacoes";

    protected $primaryKey = "id_solicitacao";

    public function getCriadoEmAttribute(){
        return date('d/m/Y - H:i:s', strtotime($this->attributes['criado_em']));
    }

    public function getDataInicioAttribute(){
        return date('d/m/Y', strtotime($this->attributes['data_inicio']));
    }

    public function getDataFimAttribute(){
        return date('d/m/Y', strtotime($this->attributes['data_fim']));
    }

    public function medicamentos(){

        return $this->belongsToMany('App\Medicamento', 'solicitacao_medicamentos', 'fk_solicitacao_id', 'fk_medicamento_id')
            ->withPivot('quantidade', 'mes1', 'mes2', 'mes3', 'mes4', 'mes5', 'mes6'); 

    }

    public function medico(){
        return $this->belongsTo('App\Medico', 'fk_medico_id', 'fk_usuario_id');
    }

    public function paciente(){
        return $this->belongsTo('App\Paciente', 'fk_paciente_id', 'fk_usuario_id');
    }

    public function autorizador(){
       return $this->belongsTo('App\User', 'fk_autorizador_id', 'id_usuario');
    }

    public function doenca(){
        return $this->belongsTo('App\Doenca', 'fk_doenca_id', 'id_doenca');
    }

    public function status(){
        return $this->belongsTo('App\Status', 'fk_status_id', 'id_status');   
    }


}

