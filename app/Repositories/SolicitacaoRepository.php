<?php 

namespace App\Repositories;

use App\Solicitacao;

class SolicitacaoRepository {

	public function getAll(){
		return Solicitacao::with(['medicamentos', 'medico.usuario','autorizador', 'paciente.usuario', 'doenca', 'status'])->get();
	}

	public function create(array $dados){

		return Solicitacao::create($dados);

	}

	public function addMedicine(Solicitacao $solicitacao, array $medicamento){

		return $solicitacao->medicamentos()->attach($medicamento['fk_medicamento_id'], ['quantidade' => $medicamento['quantidade'],
			'mes1' => $medicamento['mes1'],
			'mes2' => $medicamento['mes2'],
			'mes3' => $medicamento['mes3'],
			'mes4' => $medicamento['mes4'],
			'mes5' => $medicamento['mes5'],
			'mes6' => $medicamento['mes6'],
		]);

	}

}

