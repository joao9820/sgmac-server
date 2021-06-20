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

}