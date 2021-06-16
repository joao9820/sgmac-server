<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Repositories\FuncaoRepository;

class FuncoesController extends Controller {

	private $funcaoRepository;

	function __construct(FuncaoRepository $funcaoRepository){
		$this->funcaoRepository = $funcaoRepository;
	}

	function index(){

		return response()->json($this->funcaoRepository->getAll(), 200);

	}

}