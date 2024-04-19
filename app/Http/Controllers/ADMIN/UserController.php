<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\CryptoCurrencyService;
use App\Models\MiningMachine;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\Checkout;
use App\Models\Payment;


class UserController extends Controller
{


    public function index(){

        return view('admin.users');
    }

    private $cryptoService;

    public function __construct(CryptoCurrencyService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function Moreinfo($id){

        $user = User::FindOrfail($id);
        $btcDetails = $this->cryptoService->getBtcDetails();

        // Aqui é assegurado que a consulta é executada e obtemos uma coleção de máquinas
        $machines = MiningMachine::where('user_id', $user->id)->get();
    
        // Conta o número total de máquinas. Não é necessário usar sum() a menos que esteja somando um valor específico.
        $totalMachines = $machines->count();

        $pedido = Checkout::where('email', $user->email)
        ->where('status', 'paid')
        ->orderBy('created_at', 'asc') // 'asc' para obter o mais antigo
        ->first(); // Retorna o primeiro registro encontrado

        return view('admin.moreinfo', compact('user', 'btcDetails', 'totalMachines', 'pedido'));
    }

    public function BanUser($id) {
        $user = User::findOrFail($id);
    
        // Atribui a role 'banido'
        $user->givePermissionTo('banido');
    
        return back()->with('success', 'Usuário banido com sucesso!');
    }
    public function impersonate($id)
    {
    
        // Encontra o usuário pelo ID e verifica se não é o mesmo usuário.
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard')->withErrors('Você já está logado com este usuário.');
        }

        // Armazena o ID do usuário original na sessão para poder reverter depois.
        session()->put('impersonate', Auth::id());

        // Realiza a autenticação como o novo usuário.
        Auth::login($user);

        return redirect()->route('dashboard'); // Ou redirecione para a rota desejada.
    }
        
    public function updateRole(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::where('username', $request->username)->firstOrFail();
        
        // Removendo todas as roles atuais do usuário
        $user->roles()->detach();

        // Atribuindo a nova role ao usuário
        $user->assignRole($request->role);

        return back()->with('success', 'Role do usuário atualizada com sucesso.');
    }

    

}
