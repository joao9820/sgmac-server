<?php 

namespace App\Repositories;

use App\User;

class UserRepository {

	public function getAll(){
		return User::with('funcao')->orderBy('id_usuario', 'desc')->get();
	}

	public function getAllPacients(){
		return User::with('funcao')->orderBy('id_usuario', 'desc')->get();
	}

	public function create(array $data){

		return User::create($data);

	}

	public function delete($id){

		$user = User::find($id);

		if(!$user)
			throw new \Exception('O usuário não foi encontrado', 500);

		$user->delete();

	}

}

