<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmAccount;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function create(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'min:8', 'max:255', 'unique:users', 'not_regex:/^\+?[1-9]\d{1,14}$/', 'not_regex:/^\S+@\S+\.\S+$/'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => 'required|string|min:8|unique:users',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);

    // Gerar token de confirmação
    $token = Str::random(60);
    $cod = Str::random(4);
    DB::table('account_confirmations')->insert([
        'email' => $user->email,
        'token' => $token,
        'cod' => $cod,
        'created_at' => now(),
    ]);

    // Enviar email de confirmação
    Mail::to($user->email)->send(new ConfirmAccount($token, $cod, $user->name));

    // Redirecionar para a view, passando o token como parâmetro
    return redirect()->route('auth.cm', ['token' => $token]);
}


public function createOrder(Request $request)
      {
          $user = Auth::user();

          do {
              $txId = Str::random(8);  // Gera uma string aleatória.
          } while (Checkout::where('txId', $txId)->exists()); // Verifica se o txId já existe na tabela.
      
      
          $UpgradePlanData = [];
          if($user->hasRole('lion'))
              $UpgradePlanData = [
                  'UpgradePlanData' => [
                      'user_id' => $user->id,
                      'value' => 300,
                      'qtd' => 1,
                  ],
              ];
          elseif($user->hasRole('bear')){
                $UpgradePlanData = [
                    'UpgradePlanData' => [
                        'user_id' => $user->id,
                        'value' => 200,
                        'qtd' => 1,
                    ],
                ];
          }  
          // Cria uma nova instância de Checkout.
          $checkout = new Checkout;
      
          // Atribui valores ao modelo. Os valores são coletados do request validado.
          $checkout->txId = $txId;
          $checkout->description = json_encode($UpgradePlanData); // Converte o array para JSON
          $checkout->save();
      
          // Retorna uma resposta ou redireciona o usuário para outra página.
          return redirect()->route('checkout', ['id' => $checkout->txId]);
      }

    // Adicione aqui os métodos sendConfirmation e confirmAccount conforme os passos anteriores
}
