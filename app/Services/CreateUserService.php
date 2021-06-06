<?php 

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\MedicoRepository;


class CreateUserService {

	private $userRepository;
	private $pacienteRepository;
	private $medicoRepository;

	function __construct(UserRepository $userRepository, PacienteRepository $pacienteRepository, MedicoRepository $medicoRepository){
		$this->userRepository = $userRepository;
		$this->medicoRepository = $medicoRepository;
		$this->pacienteRepository = $pacienteRepository;
	}

	public function execute(array $dados, array $complemento = null){

		try{

			DB::beginTransaction();

				$usuario = $this->userRepository->create($dados);

				if($complemento){

					if($dados['fk_funcao_id'] == env('FUNCAO_USUARIO_PACIENTE')){

					$usuario = $this->pacienteRepository($dados, $complemento);

					}else{

						$usuario = $this->medicoRepository($dados, $complemento);				
					}
				}

			DB::commit();

			return $usuario;
				

		}catch(\Exception $e){

			DB::rollback();

			throw $e;
		}
	
	}

}

