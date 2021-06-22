<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateUserService;

class AuthController extends Controller
{

    private $createUserService;

    function __construct(CreateUserService $createUserService){
        $this->createUserService = $createUserService;
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'email' => 'required|string|email|unique:usuarios',
            'cpf'=> 'required|string|min:12|unique:usuarios',
            'telefone1' => 'required|string|min:7',
            'password' => 'required|string|confirmed',
            'fk_funcao_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $temComplemento = ($request->input('fk_funcao_id') > env('FUNCAO_USUARIO_AUTORIZADOR')) && $request->has('complemento');

        if($temComplemento){

            $rulesPaciente = [
                'tamanho' => 'required|string',
                'peso' => 'required|string',
                'nome_da_mae'=> 'required|string',
                'raca' => 'required|string',
                'etnia' => 'sometimes|string',
                'cns' => 'sometimes|string|size:6'
            ];

            $rulesMedico = [
                'cnes' => 'required|string|size:6',
                'cns' => 'required|numeric',
                'estabelecimento'=> 'required|string'
            ];

            $validatorComplement = Validator::make($request->input('complemento'), $request->input('fk_funcao_id') == env('FUNCAO_USUARIO_MEDICO') ? 
                $rulesMedico : $rulesPaciente);

            if ($validatorComplement->fails()) {
                return response()->json(["error" => $validatorComplement->errors()->first()], 400);
            }

        }

        try{

            //Adicionar verificação para paciente e médico

            $usuario = [];

            if(!$temComplemento){

                $usuario = $this->createUserService->execute($request->all());
            }else{
                $usuario = $this->createUserService->execute($request->except('complemento'), $request->input('complemento'));
            }
       
            return response()->json(["usuario" => $usuario], 201);

        }catch(\Exception $e){

            //dd($e);

            return response()->json(["error" => $e->getMessage()], 500);

        }

    }

    public function login(Request $request){

        //dd($request);

        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);


        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        //Corrigir a frase
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'E-mail e/ou senha incorreta'], 401);
        }

        return $this->respondWithToken($token);

    }

     /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

     //Verificar como buscar o nível de acesso do usuário
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => auth('api')->user(),
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function logout(Request $request){
        //Revoga o Token gerado
        auth('api')->logout();

        // Pass true to force the token to be blacklisted "forever"
        //auth()->logout(true);

        return response()->json([
            'resp' => 'Deslogado com sucesso'
        ], 200);

    }
}
