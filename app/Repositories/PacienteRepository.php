<?php 

namespace App\Repositories;

use App\Paciente;

class PacienteRepository {

	public function getAll(){
		return Paciente::with('usuario')->get();
	}

	public function create(array $dados){

		return Paciente::create($dados);

	}

}

