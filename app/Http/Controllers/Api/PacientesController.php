<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\PacienteRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateSolicitacaoService;

class PacientesController extends Controller {

	private $pacienteRepository;

	function __construct(PacienteRepository $pacienteRepository){
		$this->pacienteRepository = $pacienteRepository;
	}

	function index(){

		return response()->json($this->pacienteRepository->getAll(), 200);

	}

}