<?php 

namespace App\Repositories;

use App\Paciente;

class PacienteRepository {

	public function create(array $dados){

		return Paciente::create($dados);

	}

}

