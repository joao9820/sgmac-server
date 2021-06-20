<?php 

namespace App\Repositories;

use App\Doenca;

class DoencaRepository {

	public function find($cid10 = null){

		return $cid10 ? Doenca::where('cid_10', 'like', "%{$cid10}%")->get() : Doenca::all();

	}

}

