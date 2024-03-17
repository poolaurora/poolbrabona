<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index($id)
    {   
        // Busca o checkout com base no txId. Se não encontrar, retorna um erro 404.
        $checkout = Checkout::where('txId', $id)->firstOrFail();
    
        // Inicializa $oldCheckout como null.
        $oldCheckout = null;
    
        // Obtém o usuário autenticado.
        $user = Auth::user();
    
        // Se há um usuário autenticado e ele tem roles, tenta encontrar um oldCheckout.
        if ($user && !$user->roles->isEmpty()) {
            // Usa 'first()' ao invés de 'firstOrFail()' para evitar o erro 404 se não encontrar nenhum registro.
            $oldCheckout = Checkout::where('email', $user->email)->where('status', 'paid')->first();
        }
    
        // Passa os dados do checkout e do oldCheckout (pode ser null) para a view.
        return view('checkout.welcome', compact('checkout', 'oldCheckout'));
    }
    

    public function indexPayment($id)
    {
        $payment = Payment::where('checkout_id', $id)->firstOrFail();

        // Se o checkout for encontrado, passa os dados para a view.
        return view('checkout.payment', compact('payment'));
    }


    public function indexSucess($id)
    {
        $payment = Payment::where('checkout_id', $id)->firstOrFail();

        // Se o checkout for encontrado, passa os dados para a view.
        return view('checkout.sucess', compact('payment'));
    }



    public function createOrder(Request $request)
{
    // Valida os dados de entrada.
    $validatedData = $request->validate([
        'plan' => 'required',
    ]);


    do {
        $txId = Str::random(8);  // Gera uma string aleatória.
    } while (Checkout::where('txId', $txId)->exists()); // Verifica se o txId já existe na tabela.


    $planData = [];
    if ($validatedData['plan'] === 'shark') {
        $planData = [
            'plan' => [
                'name' => 'Shark',
                'value' => 899.90,
                'qtd' => 1,  // Defina o valor conforme necessário
            ],
        ];
    }
    elseif($validatedData['plan'] === 'bear'){
        $planData = [
            'plan' => [
                'name' => 'Bear',
                'value' => 349.90,
                'qtd' => 1,  // Defina o valor conforme necessário
            ],
        ];
    }
    elseif($validatedData['plan'] === 'lion'){
        $planData = [
            'plan' => [
                'name' => 'Lion',
                'value' => 569.90,
                'qtd' => 1,  // Defina o valor conforme necessário
            ],
        ]; 
    }
    else{
        $planData = [
            'plan' => [
                'name' => 'Shark 20% OFF',
                'value' => 719.92,
                'qtd' => 1,  // Defina o valor conforme necessário
            ],
        ]; 
    }   

    // Cria uma nova instância de Checkout.
    $checkout = new Checkout;

    // Atribui valores ao modelo. Os valores são coletados do request validado.
    $checkout->txId = $txId;
    $checkout->description = json_encode($planData); // Converte o array para JSON
    $checkout->save();

    // Retorna uma resposta ou redireciona o usuário para outra página.
    return redirect()->route('checkout', ['id' => $checkout->txId]);
}






public function processPayment(Request $request)
{
    $request->validate([
        'nome' => 'required|string',
        'cpf' => 'required|numeric|digits:11',
        'telefone' => 'required|numeric',
        'email' => 'required|email',
    ]);

    $apiKey = 'apk_40231996-EnVScRLElxPJowhJIpobCyjLchmrmADq';
    $order_id = uniqid(); 

    $checkout = Checkout::where('txId', $request->txId)->firstOrFail();
    $description = json_decode($checkout->description, true);
    $url = "https://pix.paghiper.com/invoice/create/"; 

    // Verifica se a descrição do plano existe e processa o pagamento do plano.
    if(isset($description['plan'])) {
        return $this->processPlanPayment($request, $description['plan'], $apiKey, $order_id, $checkout, $url);
    }
    elseif(isset($description['maquinas'])){
      return $this->processMaquinaPayment($request, $description['maquinas'], $apiKey, $order_id, $checkout, $url);
    }
    elseif(isset($description['upgradeMaquinas'])){
        return $this->processMaquinaUpgradePayment($request, $description['upgradeMaquinas'], $apiKey, $order_id, $checkout, $url);
      }
    elseif(isset($description['salaData'])){
        return $this->processSalaPayment($request, $description['salaData'], $apiKey, $order_id, $checkout, $url);
      }
    elseif(isset($description['UpgradePlanData'])){
        return $this->processUpgradePlanDataPayment($request, $description['UpgradePlanData'], $apiKey, $order_id, $checkout, $url);
      }
    
    

    // Retorne uma resposta padrão ou lance uma exceção se o plano não for encontrado.
    return response()->json(['error' => 'Informações do plano não encontradas.'], 404);
}










private function processPlanPayment($request, $planDescription, $apiKey, $order_id, $checkout, $url)
{
    $planValue = $planDescription['value']; 
    $planValueCents = (int)($planValue * 100);

    $client = new \GuzzleHttp\Client();
    $data = [
        'apiKey' => $apiKey,
        'order_id' => $order_id,
        'payer_email' => $request->email,
        'payer_name' => $request->nome,
        'payer_cpf_cnpj' => $request->cpf,
        'payer_phone' => $request->telefone,
        'days_due_date' => 30,
        'notification_url' => env('APP_URL') . '/api/process/webhook/order',
        'items' => [
            [
                'description' => $planDescription['name'],
                'quantity' => 1,
                'item_id' => '1',
                'price_cents' => $planValueCents,
            ],
        ],
    ];

    try {
        $response = $client->request('POST', $url, [
            'json' => $data,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() == 201) {
            $responseBody = json_decode($response->getBody(), true);
        
            $payment = new Payment;
            $payment->order_id = $responseBody['pix_create_request']['order_id'];
            $payment->status = $responseBody['pix_create_request']['status'];
            $payment->due_date = $responseBody['pix_create_request']['due_date'];
            $payment->pix_code_url = $responseBody['pix_create_request']['pix_code']['emv'];
            $payment->pix_code_base64 = $responseBody['pix_create_request']['pix_code']['qrcode_base64'];
            $payment->checkout_id = $checkout->id;
            $payment->save();
        
            return redirect()->route('checkout.payment', ['id' => $checkout->id]);
        } else {
            $responseBody = json_decode($response->getBody(), true);
            return response()->json(['error' => 'Erro ao processar o pagamento.', 'details' => $responseBody], $response->getStatusCode());
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao se conectar com a API da PagHiper: ' . $e->getMessage()], 500);
    }
}


private function processMaquinaPayment($request, $maquinaDescription, $apiKey, $order_id, $checkout, $url)
{
    $maquinaValueCents = (int)($maquinaDescription['value'] * 100);

    $client = new \GuzzleHttp\Client();
    $data = [
        'apiKey' => $apiKey,
        'order_id' => $order_id,
        'payer_email' => $request->email,
        'payer_name' => $request->nome,
        'payer_cpf_cnpj' => $request->cpf,
        'payer_phone' => $request->telefone,
        'days_due_date' => 30,
        'notification_url' => env('APP_URL') . '/api/process/webhook/order',
        'items' => [
            [
                'description' => "Aquisicao de ".$maquinaDescription['qtd']." máquinas",
                'quantity' => $maquinaDescription['qtd'],
                'item_id' => '1',
                'price_cents' => $maquinaValueCents,
            ],
        ],
    ];

    try {
        $response = $client->request('POST', $url, [
            'json' => $data,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() == 201) {
            $responseBody = json_decode($response->getBody(), true);
        
            $payment = new Payment;
            $payment->order_id = $responseBody['pix_create_request']['order_id'];
            $payment->status = $responseBody['pix_create_request']['status'];
            $payment->due_date = $responseBody['pix_create_request']['due_date'];
            $payment->pix_code_url = $responseBody['pix_create_request']['pix_code']['emv'];
            $payment->pix_code_base64 = $responseBody['pix_create_request']['pix_code']['qrcode_base64'];
            $payment->checkout_id = $checkout->id;
            $payment->save();
        
            return redirect()->route('checkout.payment', ['id' => $checkout->id]);
        } else {
            $responseBody = json_decode($response->getBody(), true);
            return response()->json(['error' => 'Erro ao processar o pagamento.', 'details' => $responseBody], $response->getStatusCode());
        }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao se conectar com a API da PagHiper: ' . $e->getMessage()], 500);
        }
}


    private function processMaquinaUpgradePayment($request, $maquinaDescription, $apiKey, $order_id, $checkout, $url)
    {
        $maquinaValueCents = (int)(250 * 100);

        $client = new \GuzzleHttp\Client();
        $data = [
            'apiKey' => $apiKey,
            'order_id' => $order_id,
            'payer_email' => $request->email,
            'payer_name' => $request->nome,
            'payer_cpf_cnpj' => $request->cpf,
            'payer_phone' => $request->telefone,
            'days_due_date' => 30,
            'notification_url' => env('APP_URL') . '/api/process/webhook/order',
            'items' => [
                [
                    'description' => "Upgrade de máquinas",
                    'quantity' => 1,
                    'item_id' => '1',
                    'price_cents' => $maquinaValueCents,
                ],
            ],
        ];

        try {
            $response = $client->request('POST', $url, [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 201) {
                $responseBody = json_decode($response->getBody(), true);
            
                $payment = new Payment;
                $payment->order_id = $responseBody['pix_create_request']['order_id'];
                $payment->status = $responseBody['pix_create_request']['status'];
                $payment->due_date = $responseBody['pix_create_request']['due_date'];
                $payment->pix_code_url = $responseBody['pix_create_request']['pix_code']['emv'];
                $payment->pix_code_base64 = $responseBody['pix_create_request']['pix_code']['qrcode_base64'];
                $payment->checkout_id = $checkout->id;
                $payment->save();
            
                return redirect()->route('checkout.payment', ['id' => $checkout->id]);
            } else {
                $responseBody = json_decode($response->getBody(), true);
                return response()->json(['error' => 'Erro ao processar o pagamento.', 'details' => $responseBody], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao se conectar com a API da PagHiper: ' . $e->getMessage()], 500);
        }
    }


    private function processSalaPayment($request, $salaDescription, $apiKey, $order_id, $checkout, $url)
    {
        $salaValueCents = (int)($salaDescription['value'] * 100);

        $client = new \GuzzleHttp\Client();
        $data = [
            'apiKey' => $apiKey,
            'order_id' => $order_id,
            'payer_email' => $request->email,
            'payer_name' => $request->nome,
            'payer_cpf_cnpj' => $request->cpf,
            'payer_phone' => $request->telefone,
            'days_due_date' => 30,
            'notification_url' => env('APP_URL') . '/api/process/webhook/order',
            'items' => [
                [
                    'description' => "Aquisicao de ".$salaDescription['qtd']." sala de mineração",
                    'quantity' => $salaDescription['qtd'],
                    'item_id' => '1',
                    'price_cents' => $salaValueCents,
                ],
            ],
        ];

        try {
            $response = $client->request('POST', $url, [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 201) {
                $responseBody = json_decode($response->getBody(), true);
            
                $payment = new Payment;
                $payment->order_id = $responseBody['pix_create_request']['order_id'];
                $payment->status = $responseBody['pix_create_request']['status'];
                $payment->due_date = $responseBody['pix_create_request']['due_date'];
                $payment->pix_code_url = $responseBody['pix_create_request']['pix_code']['emv'];
                $payment->pix_code_base64 = $responseBody['pix_create_request']['pix_code']['qrcode_base64'];
                $payment->checkout_id = $checkout->id;
                $payment->save();
            
                return redirect()->route('checkout.payment', ['id' => $checkout->id]);
            } else {
                $responseBody = json_decode($response->getBody(), true);
                return response()->json(['error' => 'Erro ao processar o pagamento.', 'details' => $responseBody], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao se conectar com a API da PagHiper: ' . $e->getMessage()], 500);
        }
    }

    private function processUpgradePlanDataPayment($request, $UpgradePlanDataDescription, $apiKey, $order_id, $checkout, $url)
    {
        $UpgradePlanDataValueCents = (int)($UpgradePlanDataDescription['value'] * 100);

        $client = new \GuzzleHttp\Client();
        $data = [
            'apiKey' => $apiKey,
            'order_id' => $order_id,
            'payer_email' => $request->email,
            'payer_name' => $request->nome,
            'payer_cpf_cnpj' => $request->cpf,
            'payer_phone' => $request->telefone,
            'days_due_date' => 30,
            'notification_url' => env('APP_URL') . '/api/process/webhook/order',
            'items' => [
                [
                    'description' => "Upgrade de plano de mineração",
                    'quantity' => $UpgradePlanDataDescription['qtd'],
                    'item_id' => '1',
                    'price_cents' => $UpgradePlanDataValueCents,
                ],
            ],
        ];

        try {
            $response = $client->request('POST', $url, [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 201) {
                $responseBody = json_decode($response->getBody(), true);
            
                $payment = new Payment;
                $payment->order_id = $responseBody['pix_create_request']['order_id'];
                $payment->status = $responseBody['pix_create_request']['status'];
                $payment->due_date = $responseBody['pix_create_request']['due_date'];
                $payment->pix_code_url = $responseBody['pix_create_request']['pix_code']['emv'];
                $payment->pix_code_base64 = $responseBody['pix_create_request']['pix_code']['qrcode_base64'];
                $payment->checkout_id = $checkout->id;
                $payment->save();
            
                return redirect()->route('checkout.payment', ['id' => $checkout->id]);
            } else {
                $responseBody = json_decode($response->getBody(), true);
                return response()->json(['error' => 'Erro ao processar o pagamento.', 'details' => $responseBody], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao se conectar com a API da PagHiper: ' . $e->getMessage()], 500);
        }
    }
}

