<?php 

namespace App\Repositories;

use App\Medicamento;

class MedicamentoRepository {

	public function getAll(){

		return Medicamento::all();

	}

}

