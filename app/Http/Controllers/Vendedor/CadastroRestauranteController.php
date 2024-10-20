<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BrasilApiService;
use App\Models\Restaurantes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CadastroRestauranteController extends Controller
{
    protected $brasilApiService;

    public function __construct(BrasilApiService $brasilApiService)
    {
        $this->brasilApiService = $brasilApiService;
    }

    public function index()
    {
        return view('vendedor.cadastro.cadastro');
    }

    public function register(Request $request)
    {
        $tipo_pessoa = $request->input('tipo_pessoa');
        $rules = [];

        if ($tipo_pessoa === 'fisica') {
            $rules = [
                'nome_estabelecimento' => ['required', 'min:3', 'max:30'],
                'cpf_responsavel' => ['required', 'cpf', 'unique:restaurantes,cpf_responsavel'],
                'email_restaurante' => ['required','email', 'unique:restaurantes,email_restaurante'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'nome_completo' => ['required', 'string', 'max:100', 'min:8', function ($attribute, $value, $fail) {
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
                'email_responsavel' => ['required', 'email', 'unique:restaurantes,email_responsavel'],
                'telefone' => ['required', 'string', 'size:15'],
                'cep' => ['required', 'string', 'size:8'],
                'rua' => ['required', 'string', 'max:50'],
                'numero_casa' => ['required', 'string', 'max:10'],
                'ponto_referencia' => ['required', 'string', 'min:5', 'max:50'],
                'bairro' => ['required', 'string', 'max:255'],
                'cidade' => ['required', 'string', 'max:255'],
                'estado' => ['required', 'string', 'size:2'],
                'url_restaurante' => ['required', 'unique:restaurantes,url_restaurante', 'string', 'min:1', 'max:100', 'regex:/^[a-zA-Z0-9\-\.]+$/'],
            ];

            // Mensagens de erro personalizadas para Pessoa Física
            $messages = [
                'nome_estabelecimento.required' => 'Este campo é obrigatório.',
                'nome_estabelecimento.min' => 'O nome do estabelecimento deve ter no minimo 3 caracteres',
                'nome_estabelecimento.max' => 'O nome do estabelecimento deve ter no máximo 30 caracteres.',

                'cpf_responsavel.required' => 'Este campo é obrigatório.',
                'cpf_responsavel.cpf' => 'O CPF deve ser válido.',
                'cpf_responsavel.unique' => 'Este CPF já está cadastrado em nossa base de dados, por favor use outro.',

                'email_restaurante.required' => 'Este campo é obrigatório.',
                'email_restaurante.email' => 'O e-mail do restaurante deve ser válido.',
                'email_restaurante.unique' => 'Este e-mail já está cadastrado em nossa base de dados, por favor use outro.',

                'password.required' => 'Por favor, insira uma senha.',
                'password.min' => 'O campo de senha é preciso ter no minimo 8 caracteres.',
                'password.confirmed' => 'As senhas não coincidem. Por favor, verifique e tente novamente.',

                'nome_completo.required' => 'Este campo é obrigatório.',
                'nome_completo.max' => 'O nome completo deve ter no máximo 100 caracteres',
                'nome_completo.min' => 'O nome completo deve ter no minimo 8 caracteres.',

                'email_responsavel.required' => 'Este campo é obrigatório.',
                'email_responsavel.email' => 'O e-mail do responsável deve ser válido.',
                'email_responsavel.unique' => 'Este e-mail já está cadastrado em nossa base de dados, por favor use outro.',

                'telefone.required' => 'Este campo é obrigatório.',
                'telefone.size' => 'O telefone deve ter 15 caracteres.',

                'cep.required' => 'Este campo é obrigatório.',
                'cep.size' => 'O CEP deve ter 8 caracteres.',

                'rua.required' => 'Este campo é obrigatório.',
                'rua.max' => 'A rua deve ter no máximo 50 caracteres.',

                'numero_casa.required' => 'Este campo é obrigatório.',
                'numero_casa.max' => 'O número da casa deve ter no máximo 10 caracteres.',

                'ponto_referencia.required' => 'Este campo é obrigatório.',
                'ponto_referencia.min' => 'O ponto de referencia deve ter no minimo 5 caracteres.',
                'ponto_referencia.max' => 'O ponto de referencia deve ter no máximo 50 caracteres.',

                'bairro.required' => 'Este campo é obrigatório.',
                'bairro.max:255' => 'O bairro deve ter no máximo 255 caracteres.',

                'cidade.required' => 'Este campo é obrigatório.',
                'cidade.max' => 'A cidade deve ter no máximo 255 caracteres.',

                'estado.required' => 'Este campo é obrigatório.',
                'estado.size' => 'O estado deve ter 2 caracteres, Ex: PE, SC, SP, RJ.',

                'url_restaurante.required' => 'Por favor, digite sua URL.',
                'url_restaurante.min' => 'Sua URL deve ter no minimo 2 caracteres.',
                'url_restaurante.max' => 'Sua URL deve ter no maxímo 100 caracteres',
                'url_restaurante.regex' => 'Sua URL deve conter apenas letras e numeros',
                'url_restaurante.unique' => 'Essa URL já existe em nossa base de dados, por favor use outro.',
            ];

            $validatedData = $request->validate($rules, $messages);

            $nome_completo = trim($validatedData['nome_completo']);
            $partes_nome = explode(' ', $nome_completo);
            $nome = array_shift($partes_nome);
            $sobrenome = implode(' ', $partes_nome);

            $endereco_completo = "$request->numero_casa $request->rua, $request->bairro, $request->cidade, $request->estado, $request->cep";
            $response = Http::get("https://geocode.search.hereapi.com/v1/geocode", [
                'q' => $endereco_completo,
                'apiKey' => env('HERE_API_KEY')
            ]);
            $data = $response->json();

            if (isset($data['items']) && count($data['items']) > 0 && $data['items'][0]['scoring']['queryScore'] >= 1.0) {
                $latitude = $data['items'][0]['position']['lat'];
                $longitude = $data['items'][0]['position']['lng'];

                $validarRestaurantes = Restaurantes::create([
                    'nome_estabelecimento' => $validatedData['nome_estabelecimento'],
                    'cpf_responsavel' => $validatedData['cpf_responsavel'],
                    'email_restaurante' => $validatedData['email_restaurante'],
                    'password' => bcrypt($validatedData['password']),
                    'nome' => $nome,
                    'sobrenome' => $sobrenome,
                    'email_responsavel' => $validatedData['email_responsavel'],
                    'telefone' => $validatedData['telefone'],
                    'cep' => $validatedData['cep'],
                    'rua' => $validatedData['rua'],
                    'numero_casa' => $validatedData['numero_casa'],
                    'ponto_referencia' => $validatedData['ponto_referencia'],
                    'bairro' => $validatedData['bairro'],
                    'cidade' => $validatedData['cidade'],
                    'estado' => $validatedData['estado'],
                    'url_restaurante' => $validatedData['url_restaurante'],
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'tipo_pessoa' => 'Fisica',
                ]);

                // Definindo uma flash message de sucesso
                Session::flash('conta-criada', 'Conta do restaurante criada com sucesso!');

                return redirect()->route('login');
            } else {
                Session::flash('endereco-invalido', 'CEP ou Endereço invalido, ou a relevância é baixa. Por favor confira se as informações estão corretas!');
                return redirect()->route('cadastro-restaurantes');
            }

        } elseif ($tipo_pessoa === 'juridica') {
            $rules = [
                'nome_estabelecimento' => ['required', 'min:3', 'max:30'],
                'cpf_responsavel' => ['required', 'cpf', 'unique:restaurantes,cpf_responsavel'],
                'email_restaurante' => ['required','email', 'unique:restaurantes,email_restaurante'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'cnpj' => ['required', 'size:18', 'cnpj', 'unique:restaurantes,cnpj'],
                'razao_social' => ['required', 'max:255', 'unique:restaurantes,razao_social'],
                'nome_completo' => ['required', 'string', 'max:100', 'min:8', function ($attribute, $value, $fail) {
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
                'email_responsavel' => ['required', 'email', 'unique:restaurantes,email_responsavel'],
                'telefone' => ['required', 'string', 'size:15'],
                'cep' => ['required', 'string', 'size:8'],
                'rua' => ['required', 'string', 'max:50'],
                'numero_casa' => ['required', 'string', 'max:10'],
                'ponto_referencia' => ['required', 'string', 'min:5', 'max:50'],
                'bairro' => ['required', 'string', 'max:255'],
                'cidade' => ['required', 'string', 'max:255'],
                'estado' => ['required', 'string', 'size:2'],
                'url_restaurante' => ['required', 'unique:restaurantes,url_restaurante', 'string', 'min:1', 'max:100', 'regex:/^[a-zA-Z0-9\-\.]+$/'],
            ];

            // Mensagens de erro personalizadas para Pessoa Juridica
            $messages = [
                'nome_estabelecimento.required' => 'Este campo é obrigatório.',
                'nome_estabelecimento.min' => 'O nome do estabelecimento deve ter no minimo 3 caracteres',
                'nome_estabelecimento.max' => 'O nome do estabelecimento deve ter no máximo 30 caracteres.',

                'cpf_responsavel.required' => 'Este campo é obrigatório.',
                'cpf_responsavel.cpf' => 'O CPF deve ser válido.',
                'cpf_responsavel.unique' => 'Este CPF já está cadastrado em nossa base de dados, por favor use outro.',

                'email_restaurante.required' => 'Este campo é obrigatório.',
                'email_restaurante.email' => 'O e-mail do restaurante deve ser válido.',
                'email_restaurante.unique' => 'Este e-mail já está cadastrado em nossa base de dados, por favor use outro.',

                'password.required' => 'Por favor, insira uma senha.',
                'password.min' => 'O campo de senha é preciso ter no minimo 8 caracteres.',
                'password.confirmed' => 'As senhas não coincidem. Por favor, verifique e tente novamente.',

                'cnpj.required' => 'Este campo é obrigatório.',
                'cnpj.cnpj' => 'O CNPJ deve ser válido.',
                'cnpj.unique' => 'Este CNPJ já está cadastrado em nossa base de dados, por favor use outro.',
                'cnpj.size' => 'O CNPJ tem que ter exatamente 18 caracteres.',

                'razao_social.required' => 'Este campo é obrigatório.',
                'razao_social.max' => 'A razão social deve ter no máximo 255 caracteres.',
                'razao_social.unique' => 'Esta razão social já está cadastrado em nossa base de dados.',

                'nome_completo.required' => 'Este campo é obrigatório.',
                'nome_completo.max' => 'O nome completo deve ter no máximo 100 caracteres',
                'nome_completo.min' => 'O nome completo deve ter no minimo 8 caracteres.',

                'email_responsavel.required' => 'Este campo é obrigatório.',
                'email_responsavel.email' => 'O e-mail do responsável deve ser válido.',
                'email_responsavel.unique' => 'Este e-mail já está cadastrado em nossa base de dados, por favor use outro.',

                'telefone.required' => 'Este campo é obrigatório.',
                'telefone.size' => 'O telefone deve ter 15 caracteres.',

                'cep.required' => 'Este campo é obrigatório.',
                'cep.size' => 'O CEP deve ter 8 caracteres.',

                'rua.required' => 'Este campo é obrigatório.',
                'rua.max' => 'A rua deve ter no máximo 50 caracteres.',

                'numero_casa.required' => 'Este campo é obrigatório.',
                'numero_casa.max' => 'O número da casa deve ter no máximo 10 caracteres.',

                'ponto_referencia.required' => 'Este campo é obrigatório.',
                'ponto_referencia.min' => 'O ponto de referencia deve ter no minimo 5 caracteres.',
                'ponto_referencia.max' => 'O ponto de referencia deve ter no máximo 50 caracteres.',

                'bairro.required' => 'Este campo é obrigatório.',
                'bairro.max' => 'O bairro deve ter no máximo 255 caracteres.',

                'cidade.required' => 'Este campo é obrigatório.',
                'cidade.max' => 'A cidade deve ter no máximo 255 caracteres.',

                'estado.required' => 'Este campo é obrigatório.',
                'estado.size' => 'O estado deve ter 2 caracteres, Ex: PE, SC, SP, RJ.',

                'url_restaurante.required' => 'Por favor, digite sua URL.',
                'url_restaurante.min' => 'Sua URL deve ter no minimo 2 caracteres.',
                'url_restaurante.max' => 'Sua URL deve ter no maxímo 100 caracteres',
                'url_restaurante.regex' => 'Sua URL deve conter apenas letras e numeros',
                'url_restaurante.unique' => 'Essa URL já existe em nossa base de dados, por favor use outro.',
            ];

            $validatedData = $request->validate($rules, $messages);

            $nome_completo = trim($validatedData['nome_completo']);
            $partes_nome = explode(' ', $nome_completo);
            $nome = array_shift($partes_nome);
            $sobrenome = implode(' ', $partes_nome);

            $endereco_completo = "$request->numero_casa $request->rua, $request->bairro, $request->cidade, $request->estado, $request->cep";
            $response = Http::get("https://geocode.search.hereapi.com/v1/geocode", [
                'q' => $endereco_completo,
                'apiKey' => env('HERE_API_KEY')
            ]);
            $data = $response->json();

            if (isset($data['items']) && count($data['items']) > 0 && $data['items'][0]['scoring']['queryScore'] >= 1.0) {
                $latitude = $data['items'][0]['position']['lat'];
                $longitude = $data['items'][0]['position']['lng'];

                Restaurantes::create([
                    'nome_estabelecimento' => $validatedData['nome_estabelecimento'],
                    'cpf_responsavel' => $validatedData['cpf_responsavel'],
                    'email_restaurante' => $validatedData['email_restaurante'],
                    'password' => bcrypt($validatedData['password']),
                    'nome' => $nome,
                    'sobrenome' => $sobrenome,
                    'email_responsavel' => $validatedData['email_responsavel'],
                    'cnpj' => $validatedData['cnpj'],
                    'razao_social' => $validatedData['razao_social'],
                    'telefone' => $validatedData['telefone'],
                    'cep' => $validatedData['cep'],
                    'rua' => $validatedData['rua'],
                    'numero_casa' => $validatedData['numero_casa'],
                    'ponto_referencia' => $validatedData['ponto_referencia'],
                    'bairro' => $validatedData['bairro'],
                    'cidade' => $validatedData['cidade'],
                    'estado' => $validatedData['estado'],
                    'url_restaurante' => $validatedData['url_restaurante'],
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'tipo_pessoa' => 'Juridica',
                ]);

                Session::flash('conta-criada-restaurante', 'Conta do restaurante criada com sucesso!');

                return redirect()->route('login');
            } else {
                Session::flash('endereco-invalido', 'CEP ou endereço invalido, ou a relevância é baixa. Por favor confira se as informações estão corretas!');
                return redirect()->route('cadastro-restaurantes');
            }
        } else {
            Session::flash('tipo-invalido', 'Tipo de pessoa inválido.');
            return redirect()->route('cadastro-restaurantes');
        }
    }
}
