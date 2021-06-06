<?php 

namespace App\Repositories;

use App\Medico;

class MedicoRepository {

	public function create(array $dados){

		return Medico::create($dados);

	}

}

