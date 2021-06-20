<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateSolicitacaoService;
use App\Repositories\SolicitacaoRepository;

class SolicitacoesController extends Controller {

	private $createSolicitacaoService;
    private $solicitacaoRepository;

	function __construct(CreateSolicitacaoService $createSolicitacaoService, SolicitacaoRepository $solicitacaoRepository){
		$this->createSolicitacaoService = $createSolicitacaoService;
        $this->solicitacaoRepository = $solicitacaoRepository;
	}

	function index(){

		return response()->json($this->solicitacaoRepository->getAll(), 200);

	}

	function store(Request $request){

		 $validator = Validator::make($request->all(), [
            'fk_medico_id' => 'required|numeric',
            'fk_paciente_id' => 'required|numeric',
            'fk_doenca_id'=> 'required|numeric',
            'medicamentos' => 'required|array',
            'medicamentos.*.fk_medicamento_id' => 'required|numeric',
            'medicamentos.*.quantidade' => 'required|numeric|min:1',
            'medicamentos.*.mes1' => 'required|boolean',
            'diagnostico' => 'required|string',
            'anamnese' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        //dd($request->all());

        try{

        	$this->createSolicitacaoService->execute($request->except('medicamentos'), $request->input('medicamentos'));

        	return response()->json("A solicitação foi registrada com sucesso, aguarde a resposta do autorizador e boa sorte!", 201);

        }catch(\Exception $err){

        	return response()->json($err->getMessage(), 500);

        }

	}

}