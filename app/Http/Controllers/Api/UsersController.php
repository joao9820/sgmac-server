<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateSolicitacaoService;

class UsersController extends Controller {

	private $userRepository;

	function __construct(UserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

	function index(){

		return response()->json($this->userRepository->getAll(), 200);

	}

	function destroy($id){

		try{

			$this->userRepository->delete($id);

			return  response()->json([], 204);

		}catch(\Exception $e){

			//dd($e->getCode());

			if($e->getCode() == "23000"){
				return response()->json(["error" => "Não é possível apagar o usuário, pois ele está relacionado a uma solicitação"], 500);
			}

			return response()->json(["error" => $e->getMessage()], 500);

		}

	}

}