<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\BrasilApiService;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller {
    protected $brasilApiService;

    public function _construct(BrasilApiService $brasilApiService)
    {
        $this->brasilApiService = $brasilApiService;
    }

    public function index() {
        return view('login.registrar');
    }

    public function create(Request $request) {
        $dadosValidados = $request->validate([
            'nome_completo' => ['required', 'min:2', 'string', function ($attribute, $value, $fail) {
                $partes_nome = explode(' ', trim($value));
                if (count($partes_nome) < 2) {
                    $fail('Por favor, insira o sobrenome.');
                } else {
                    $sobrenome = array_pop($partes_nome);
                    if (strlen(trim($sobrenome)) < 3) {
                        $fail('O sobrenome deve ter no mínimo 3 caracteres.');
                    }
                }
            }],
            'telefone' => 'required|string|max:15|min:15',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'cpf' => 'required|string|max:14|min:14|unique:users,cpf|cpf',
            'cep' => 'required|string|max:8|min:8',
            'rua' => 'required|string',
            'numero_casa' => ['required', 'string', 'max:10'],
            'ponto_referencia' => 'required|string|min:3',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
        ], [
            'nome_estabelecimento.required' => 'Este campo é obrigatório.',
            'nome_estabelecimento.min' => 'O nome do estabelecimento deve ter no minimo 3 caracteres',
            'nome_estabelecimento.max' => 'O nome do estabelecimento deve ter no máximo 30 caracteres.',

            'nome_completo.required' => 'Este campo é obrigatório.',
            'nome_completo.max' => 'O nome completo deve ter no máximo 100 caracteres',
            'nome_completo.min' => 'O nome completo deve ter no minimo 8 caracteres.',

            'telefone.required' => 'O campo de telefone é obrigatorio.',
            'telefone.max' => 'O campo de telefone é preciso ter no máximo 15 caracteres.',
            'telefone.min' => 'O campo de telefone é preciso ter no minimo 15 caracteres.',

            'email.required' => 'O campo de e-mail é obrigatorio.',
            'email.unique' => 'Este email já está em uso, por favor use outro e-mail.',

            'password.required' => 'Por favor, insira uma senha.',
            'password.min' => 'O campo de senha é preciso ter no minimo 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem. Por favor, verifique e tente novamente.',

            'cpf.required' => 'O campo de cpf é obrigatorio.',
            'cpf.max' => 'O campo de cpf é preciso ter no máximo 14 caracteres.',
            'cpf.min' => 'O campo de cpf é preciso ter no minimo 14 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado em nossa base de dados, por favor use outro.',
            'cpf.cpf' => 'O CPF deve ser válido.',

            'cep.required' => 'O campo de cep é obrigatorio.',
            'cep.max' => 'O campo de cep é preciso ter no máximo 8 caracteres.',
            'cep.min' => 'O campo de cep é preciso ter no minimo 8 caracteres.',

            'rua.required' => 'O campo de rua é obrigatorio',

            'ponto_referencia.required' => 'Este campo é obrigatorio',
            'ponto_referencia.min' => 'Este campo é preciso ter no minimo 3 caracteres.',

            'numero_casa.required' => 'Este campo é obrigatorio',
            'numero_casa.max' => 'Este campo é preciso ter no máximo 10 caracteres.',

            'bairro.required' => 'O campo de bairro é obrigatorio',

            'cidade.required' => 'O campo de cidade é obrigatorio',

            'estado.required' => 'O campo de estado é obrigatorio',
        ]);

        $nome_completo = trim($dadosValidados['nome_completo']);
        $partes_nome = explode(' ', $nome_completo);
        $nome = array_shift($partes_nome);
        $sobrenome = implode(' ', $partes_nome);

        $endereco_completo = "$request->numero_casa $request->rua, $request->bairro, $request->cidade, $request->estado, $request->cep";
        $response = Http::get("https://geocode.search.hereapi.com/v1/geocode", [
            'q' => $endereco_completo,
            'apiKey' => env('HERE_API_KEY')
        ]);
        $data = $response->json();

        if (isset($data['items']) && count($data['items']) > 0 && $data['items'][0]['scoring']['queryScore'] >= 0.8) {
            $latitude = $data['items'][0]['position']['lat'];
            $longitude = $data['items'][0]['position']['lng'];

            // Cria uma instância do modelo User e salva os dados no banco de dados
            $user = new User;
            $user->nome = $nome;
            $user->sobrenome = $sobrenome;
            $user->telefone = $dadosValidados['telefone'];
            $user->email = $dadosValidados['email'];
            $user->password = bcrypt($dadosValidados['password']); // Criptografa a senha antes de salvar
            $user->cpf = $dadosValidados['cpf'];
            $user->cep = $dadosValidados['cep'];
            $user->rua = $dadosValidados['rua'];
            $user->numero_casa = $dadosValidados['numero_casa'];
            $user->ponto_referencia = $dadosValidados['ponto_referencia'];
            $user->bairro = $dadosValidados['bairro'];
            $user->cidade = $dadosValidados['cidade'];
            $user->estado = $dadosValidados['estado'];
            $user->latitude = $latitude;
            $user->longitude = $longitude;
            $user->status = 1;
            $user->save();

            Session::flash('conta-criada', 'Conta criada com sucesso!');

            return redirect()->route('login');
        } else {
            Session::flash('endereco-invalido', 'CEP ou endereço invalido, ou a relevância é baixa.<br/> Por favor confira se as informações estão corretas!');
            return redirect()->route('registrar');
        }
    }
}
