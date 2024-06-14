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
use App\Models\IpDetail;


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
        // Encontra o usuário a ser banido
        $user = User::findOrFail($id);
    
        // 1. Marcar como `banned = true` todos os IPs na tabela `IpDetail` que têm `user_id` igual ao do usuário banido
        $userIps = IpDetail::where('user_id', $user->id)->get();
    
        // Array para armazenar os IDs dos usuários que serão banidos
        $bannedUserIds = [$user->id];
    
        foreach ($userIps as $userIp) {
            $userIp->banned = true;
            $userIp->save();
    
            // 2. Consultar cada um desses IPs banidos e verificar se eles têm algum outro `user_id` associado a eles
            $otherUserIps = IpDetail::where('ip', $userIp->ip)->where('user_id', '!=', $user->id)->get();
    
            foreach ($otherUserIps as $otherUserIp) {
                $otherUserIp->banned = true;
                $otherUserIp->save();
    
                // Adiciona o user_id do outro usuário à lista de IDs de usuários banidos
                if (!in_array($otherUserIp->user_id, $bannedUserIds)) {
                    $bannedUserIds[] = $otherUserIp->user_id;
                }
            }
        }
    
        // 3. Marcar como `banned` os registros onde o `user_id` é `null` e o IP foi acessado pelo usuário banido
        $nullUserIps = IpDetail::whereNull('user_id')->whereIn('ip', $userIps->pluck('ip'))->get();
        foreach ($nullUserIps as $nullUserIp) {
            $nullUserIp->banned = true;
            $nullUserIp->save();
        }
    
        // 4. Associar a permissão de "banido" a todos os usuários que foram banidos
        foreach ($bannedUserIds as $bannedUserId) {
            $bannedUser = User::find($bannedUserId);
            if ($bannedUser) {
                $bannedUser->givePermissionTo('banido');
            }
        }
    
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
