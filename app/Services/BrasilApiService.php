<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrasilApiService {
    public function validateCnpj($cnpj) {
        // Remover a formatação do CNPJ (caracteres não numéricos)
        $cnpj = preg_replace('/\D/', '', $cnpj);

        // Verificar se o CNPJ tem o comprimento correto após a limpeza
        if (strlen($cnpj) !== 14) {
            \Log::error('Invalid CNPJ length', ['cnpj' => $cnpj]);
            return null;
        }

        // Log do CNPJ sem formatação
        \Log::info('CNPJ for API request', ['cnpj' => $cnpj]);

        try {
            // Faz a requisição para a API usando o CNPJ fornecido
            $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/" . $cnpj);

            // Log da resposta da API
            \Log::info('API CNPJ Response', ['status' => $response->status(), 'body' => $response->body()]);

            // Verifica se a resposta foi bem-sucedida
            if ($response->successful()) {
                $data = $response->json();

                // Log da resposta JSON
                \Log::info('Parsed API CNPJ Response', ['data' => $data]);

                // Checa se a resposta contém o CNPJ esperado
                if (isset($data['cnpj']) && $data['cnpj'] === $cnpj) {
                    return $data;
                } else {
                    \Log::error('CNPJ mismatch in API response', ['expected' => $cnpj, 'response_cnpj' => $data['cnpj'] ?? 'not found']);
                }
            } elseif ($response->clientError()) {
                \Log::error('Client error while validating CNPJ', ['status' => $response->status(), 'body' => $response->body()]);
            } elseif ($response->serverError()) {
                \Log::error('Server error while validating CNPJ', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Exception $e) {
            \Log::error('Exception occurred while validating CNPJ', ['error' => $e->getMessage()]);
        }

        // Retorna null se a validação falhar
        return null;
    }

    public function validateCpf($cpf) {
        // Remove qualquer formatação antes de chamar a API
        $cpf = preg_replace('/\D/', '', $cpf);

        // Log do CPF formatado
        \Log::info('Formatted CPF for API', ['cpf' => $cpf]);

        try {
            $response = Http::get("https://brasilapi.com.br/api/cpf/v1/" . $cpf);

            // Log da resposta da API
            \Log::info('API CPF Response', ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                $data = $response->json();
                // Adicione lógica aqui para verificar o CPF nos dados retornados
                return $data;
            } elseif ($response->clientError()) {
                \Log::error('Client error while validating CPF', ['status' => $response->status(), 'body' => $response->body()]);
            } elseif ($response->serverError()) {
                \Log::error('Server error while validating CPF', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Exception $e) {
            \Log::error('Exception occurred while validating CPF', ['error' => $e->getMessage()]);
        }

        return null;
    }

}
