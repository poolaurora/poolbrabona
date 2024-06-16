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
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;
use App\Models\Afiliados;


class CheckoutController extends Controller
{
    public function index(Request $request, $id)
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
    
        $cookieReferralCode = $request->cookie('AffiliateCodeCookie');

        // Passa os dados do checkout e do oldCheckout (pode ser null) para a view.
        return view('checkout.welcome', compact('checkout', 'oldCheckout', 'cookieReferralCode'));
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

    $checkout->cpf = $request->cpf;
    $checkout->nome = $request->nome;
    $checkout->telefone = $request->telefone;
    $checkout->email = $request->email;

    if ($request->afid !== null) {
        $afiliado = Afiliados::where('codigo_afiliado', $request->afid)->first();
        if ($afiliado) {
            $checkout->afiliacao = $request->afid;
        }
    }

    $checkout->save();

    $description = json_decode($checkout->description, true);
    $url = "https://api.sqala.tech/core/v1/pix-qrcode-payments"; 

    return $this->processPaymentData($request, $description, $order_id, $checkout, $url);

    // Retorne uma resposta padrão ou lance uma exceção se o plano não for encontrado.
    return response()->json(['error' => 'Informações do plano não encontradas.'], 404);
}


private function processPaymentData($request, $description, $order_id, $checkout, $url)
{

    $idempotencyKey = Uuid::uuid4()->toString();

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


    function generateRandomEmail($baseEmail) {
        // Separar o nome de usuário e o domínio do email
        list($username, $domain) = explode('@', $baseEmail);
    
        // Gerar um número aleatório
        $randomNumber = rand(1000, 9999);
    
        // Anexar o número aleatório ao nome de usuário
        $newUsername = $username . $randomNumber;
    
        // Combinar o novo nome de usuário com o domínio original
        $randomEmail = $newUsername . '@' . $domain;
    
        return $randomEmail;
    }
    
    // Exemplo de uso
    $originalEmail = $request->email;
    $randomEmail = generateRandomEmail($originalEmail);

    $orderValueInCents = intval($orderValue * 100);

    $data = [
        'amount' => $orderValueInCents,
        'code' => $order_id,
    ];   

    try {
        $appId = env('APP_ID_SQALA');
        $appSecret = env('APP_SECRET');
        $refreshToken = env('REFRESH_TOKEN');
    
        $base64Credentials = base64_encode("{$appId}:{$appSecret}");
    
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $base64Credentials,
            'Content-Type' => 'application/json'
        ])->post('https://api.sqala.tech/core/v1/access-tokens', [
            'refreshToken' => $refreshToken
        ]);
    
        if ($response->failed()) {
            throw new \Exception('Falha ao obter access token: ' . $response->body());
        }
    
        $dataResponse = $response->json();
        $token = $dataResponse['token'] ?? null;
    
        if (!$token) {
            throw new \Exception('Access token não encontrado na resposta');
        }
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.sqala.tech/core/v1/pix-qrcode-payments', $data);
    
    
        if ($response->failed()) {
            throw new \Exception('Falha na solicitação POST: ' . $response->body());
        }
    
        $responseBody = $response->json();
        $qr_code = base64_encode($responseBody['payload']);
    
        // Certifique-se de que a ordem e checkout são válidos e definidos
        if (!isset($order_id) || !isset($checkout->id)) {
            throw new \Exception('order_id ou checkout id não definidos');
        }
    
        $payment = new Payment;
        $payment->order_id = $order_id;
        $payment->status = 'pending';
        $payment->due_date = now();
        $payment->pix_code_url = $responseBody['payload'];
        $payment->pix_code_base64 = $qr_code;
        $payment->checkout_id = $checkout->id;
        $payment->save();
    
    
        return redirect()->route('checkout.payment', ['id' => $checkout->id]);
    } catch (\Exception $e) {
        Log::error('Erro ao processar pagamento', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    
        return response()->json(['error' => 'Erro ao se conectar com a API: ' . $e->getMessage()], 500);
    }
}
}

