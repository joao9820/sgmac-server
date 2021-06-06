<?php 

namespace App\Repositories;

use App\Medico;

class MedicoRepository {

	public function create(array $dados, $usuario_id){

		return Medico::create($dados);

	}

}

