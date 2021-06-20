<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\DoencaRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateSolicitacaoService;

class DoencasController extends Controller {

	private $doencaRepository;

	function __construct(DoencaRepository $doencaRepository){
		$this->doencaRepository = $doencaRepository;
	}

	function index(Request $request){

		if($request->has('search')){
			$doencas = $this->doencaRepository->find($request->input('search'));
		}else{
			$doencas = $this->doencaRepository->find();
		}

		return response()->json($doencas, 200);

	}

}