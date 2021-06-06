<?php 

namespace App\Repositories;

use App\User;

class UserRepository {

	public function create(array $data){

		return User::create($data);

	}

}

