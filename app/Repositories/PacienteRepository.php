<?php 

namespace App\Repositories;

use App\Paciente;

class PacienteRepository {

	public function create(array $dados, $usuario_id){

		return Paciente::create($dados);

	}

}

