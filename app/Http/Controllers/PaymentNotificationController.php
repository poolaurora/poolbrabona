<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


class PaymentNotificationController extends Controller
{
    public function receiveNotification(Request $request)
    {
        $apiKey = $request->input('apiKey');
        $transactionId = $request->input('transaction_id');
        $notificationId = $request->input('notification_id');
        $yourToken = "IAW0YJ63U2BMGB6B16OJFS9DCZ6ALA366FZ1Z5JANG25";

        $confirmationData = [
            'token' => $yourToken,
            'apiKey' => $apiKey,
            'transaction_id' => $transactionId,
            'notification_id' => $notificationId,
        ];

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post('https://pix.paghiper.com/invoice/notification/', [
                'json' => $confirmationData
            ]);

            if ($response->getStatusCode() == 201) {
                $responseBody = json_decode($response->getBody(), true);

                // Você deve verificar se o responseBody e as chaves necessárias existem.
                if (!isset($responseBody['status_request']) || !isset($responseBody['status_request']['order_id'])) {
                    return response()->json(['error' => 'Não foi possível encontrar o ID do pedido no payload.'], 400);
                }

                $transactionId = $responseBody['status_request']['order_id'];
                $pedido = Payment::where('order_id', $transactionId)->first();

                if (!$pedido) {
                    return response()->json(['error' => 'Pedido não encontrado.'], 404);
                }

                $description = json_decode($pedido->checkout->description, true);

                $response->getBody();

                $url = '';
                if (isset($description['plan'])) {
                    $url = '/api/process/plan/order';
                } elseif (isset($description['maquinas'])) {
                    $url = '/api/process/maquinas/order';
                } elseif (isset($description['salaData'])) {
                    $url = '/api/process/salas/order';
                } elseif (isset($description['upgradeMaquinas'])) {
                    $url = '/api/process/maquinasUp/order';
                } elseif (isset($description['UpgradePlanData'])) {
                    $url = '/api/process/planUpgrade/order';
                } else {
                    return response()->json(['error' => 'Tipo de compra não identificado'], 400);
                }
                
                // Envia a requisição POST para a URL adequada
                $response = Http::post(url($url), $responseBody);
                
                // Retorna a resposta recebida do controller destinatário
                return $response;


            } else {
                // Captura o corpo da resposta da PagHiper.
                $errorResponseBody = $response->getBody()->getContents();
                
                // Tenta decodificar o corpo da resposta. Se não for possível, usa o corpo inteiro.
                $errorResponse = json_decode($errorResponseBody, true);
                
                // Verifica se há uma mensagem de erro no JSON decodificado. Se não, usa o corpo da resposta.
                $errorMessage = $errorResponse['message'] ?? 'Erro desconhecido: ' . $errorResponseBody;
                
                return response()->json(['error' => $errorMessage], $response->getStatusCode());
            }
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao enviar confirmação: ' . $e->getMessage()], 500);
        }
    }
}

