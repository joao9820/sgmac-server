<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Repositories\SolicitacaoRepository;

class CreateSolicitacaoService {

	private $solicitacaoRepository;

	function __construct(SolicitacaoRepository $solicitacaoRepository){
		$this->solicitacaoRepository = $solicitacaoRepository;
	}


	public function execute($dados, array $medicamentos){


		try{

			DB::beginTransaction();

				$solicitacao = $this->solicitacaoRepository->create($dados);

				//dd($solicitacao);

				foreach($medicamentos as $medicamento){


					$this->solicitacaoRepository->addMedicine($solicitacao, $medicamento);


				}

			DB::commit();

			return $solicitacao->load('medicamentos');
				

		}catch(\Exception $e){

			DB::rollback();

			throw $e;
		}

		
	}


}