<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\MedicamentoRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateSolicitacaoService;

class MedicamentosController extends Controller {

	private $medicamentoRepository;

	function __construct(MedicamentoRepository $medicamentoRepository){
		$this->medicamentoRepository = $medicamentoRepository;
	}

	function index(){

		return response()->json($this->medicamentoRepository->getAll(), 200);

	}

}