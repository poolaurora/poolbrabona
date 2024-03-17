<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Services\CryptoCurrencyService;

class SaquesController extends Controller
{

    private $cryptoService;

    public function __construct(CryptoCurrencyService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function index()
    {
        // Defina o número de itens por página, por exemplo, 10
        $withdrawals = Withdrawal::where('status', 'pending')->paginate(10);
        $btcDetails = $this->cryptoService->getBtcDetails();

        return view('admin.saques', compact('withdrawals', 'btcDetails'));
    }



    public function update(Request $request, $id)
{
    $request->validate([
        'action' => 'required|in:1,2', // 1: Recusar, 2: Aprovar
    ]);

    $withdrawal = Withdrawal::findOrFail($id);

    if ($request->action == '1') {
        // Recusar
        $withdrawal->status = 'refused';
        
        // Encontra o usuário associado ao saque
        $user = $withdrawal->user;
        
        // Encontra o objeto Balance associado ao usuário e atualiza seu saldo
        $balance = $user->balance;
        $balance->balance += $withdrawal->amount;
        $balance->save();
    }
     elseif ($request->action == '2') {
        // Aprovar
        $withdrawal->status = 'approved';
    }

    $withdrawal->save();

    return back()->with('success', 'Ação realizada com sucesso!');
}

}
