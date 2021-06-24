<?php 

namespace App\Repositories;

use App\Solicitacao;

class SolicitacaoRepository {

	public function getAll(){
		return Solicitacao::with(['medicamentos', 'medico.usuario','autorizador', 'paciente.usuario', 'doenca', 'status'])->orderBy('id_solicitacao', 'desc')->get();
	}

	public function create(array $dados){

		return Solicitacao::create($dados);

	}

	public function authorize($id, $dados){

		$solicitacao = Solicitacao::find($id);

		if(!$solicitacao)
			throw new \Exception('A solicitação não foi encontrada', 500);


		$solicitacao->fk_autorizador_id = $dados['fk_autorizador_id'];
		$solicitacao->fk_status_id = $dados['fk_status_id'];

		$solicitacao->observacao = (array_key_exists('observacao', $dados) && $dados['observacao'] && $dados['fk_status_id'] > 1) ? $dados['observacao'] : null;

		$solicitacao->data_inicio = date('Y-m-d');

		$solicitacao->data_fim = (new \DateTime())->modify('+6 month')->format('Y-m-d');

		$solicitacao->save();

		return $solicitacao->load(['status', 'autorizador']);
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

