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
use Illuminate\Support\Facades\Log;

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

    $order_id = uniqid(); 

    $checkout = Checkout::where('txId', $request->txId)->firstOrFail();
    $description = json_decode($checkout->description, true);
    $url = "https://api.mercadopago.com/v1/payments"; 

    return $this->processPaymentData($request, $description, $order_id, $checkout, $url);

    // Retorne uma resposta padrão ou lance uma exceção se o plano não for encontrado.
    return response()->json(['error' => 'Informações do plano não encontradas.'], 404);
}






private function processPaymentData($request, $description, $order_id, $checkout, $url)
{
    $client = new \GuzzleHttp\Client();

    if (isset($description['plan'])) {
        $orderValue = $description['plan']['value'];
    } elseif (isset($description['maquinas'])) {
        $orderValue = $description['maquinas']['value'];
    } elseif (isset($description['upgradeMaquinas'])) {
        $orderValue = $description['upgradeMaquinas']['value'];
    } elseif (isset($description['salaData'])) {
        $orderValue = $description['salaData']['value'];
    } elseif (isset($description['UpgradePlanData'])) {
        $orderValue = $description['UpgradePlanData']['value'];
    } else {
        return response()->json(['error' => 'erro ao processar descricao'], 500);
    }

    $nomeCompleto = explode(" ", $request->nome, 2);
    $primeiroNome = $nomeCompleto[0];
    $sobrenome = $nomeCompleto[1] ?? '';
    $ddd = substr(preg_replace('/\D/', '', $request->telefone), 0, 2);
    $telefone = substr(preg_replace('/\D/', '', $request->telefone), 2);

    $data = [
        'transaction_amount' => (float)$orderValue,
        'payment_method_id' => 'pix',
        'payer' => [
            'email' => $request->email,
            'first_name' => $primeiroNome,
            'last_name' => $sobrenome,
            'identification' => [
                'number' => $request->cpf,
                'type' => 'CPF',
            ],
            'phone' => [
                'area_code' => $ddd,
                'number' => $telefone,
            ],
        ],
        'notification_url' => env('APP_URL') . '/api/process/webhook/order',
        'external_reference' => $order_id,
    ];   

    try {
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . env('MERCADOPAGO_ACCESS_TOKEN'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $data,
        ]);

            $responseBody = json_decode($response->getBody(), true);
            $payment = new Payment;
            $payment->order_id = $responseBody['external_reference'];
            $payment->status = $responseBody['status'];
            $payment->due_date = now();
            $payment->pix_code_url = $responseBody['point_of_interaction']['transaction_data']['qr_code'];
            $payment->pix_code_base64 = $responseBody['point_of_interaction']['transaction_data']['qr_code_base64'];
            $payment->checkout_id = $checkout->id;
            $payment->save();
        
            return redirect()->route('checkout.payment', ['id' => $checkout->id]);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao se conectar com a API do Mercado Pago: ' . $e->getMessage()], 500);
    }
}
}

