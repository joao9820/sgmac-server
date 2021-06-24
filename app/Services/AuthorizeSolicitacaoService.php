<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Repositories\SolicitacaoRepository;

class AuthorizeSolicitacaoService {

	private $solicitacaoRepository;

	function __construct(SolicitacaoRepository $solicitacaoRepository){
		$this->solicitacaoRepository = $solicitacaoRepository;
	}


	public function execute($id, $dados){

		try{
		
			return $this->solicitacaoRepository->authorize($id, $dados);				

		}catch(\Exception $e){

			throw $e;
		}

		
	}


}