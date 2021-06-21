<?php 

namespace App\Repositories;

use App\User;

class UserRepository {

	public function getAll(){
		return User::with('funcao')->get();
	}

	public function getAllPacients(){
		return User::with('funcao')->get();
	}

	public function create(array $data){

		return User::create($data);

	}

}

