<?php 

namespace App\Repositories;

use App\Funcao;

class FuncaoRepository {

	public function getAll(){
		return Funcao::all();
	}

}