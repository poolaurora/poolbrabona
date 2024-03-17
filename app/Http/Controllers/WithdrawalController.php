<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;
use App\Models\Withdrawal;
use App\Services\CryptoCurrencyService;


class WithdrawalController extends Controller
{

    private $cryptoService;

    public function __construct(CryptoCurrencyService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function showBtcToBrlRate()
    {
        $rate = $this->cryptoService->getBtcToBrlRate();
        return response()->json(['btc_to_brl' => $rate]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);
    
        $user = Auth::user();
        $btcDetails = $this->cryptoService->getBtcDetails();
        // Simulando a taxa de conversão para exemplo, substitua pelo valor correto obtido do serviço
        $btcToBrlRate = (float)str_replace(',', '.', preg_replace('/[^\d,]/', '', $btcDetails['price']));
    
        $userMachinesCount = $user->miningMachines->count();
        $minWithdrawalLimitInReais = $userMachinesCount * 500; // R$500 por máquina
    
        // Converte o limite mínimo em reais para BTC
        $minWithdrawalLimitInBTC = $minWithdrawalLimitInReais / $btcToBrlRate;
    
        if ($request->amount < $minWithdrawalLimitInBTC) {
            return back()->withErrors(['message' => "O valor mínimo para saque é R$" . number_format($minWithdrawalLimitInReais, 2, ',', '.') . " (ou " . number_format($minWithdrawalLimitInBTC, 8, '.', '') . " BTC)."]);
        }
    
        $balanceInBtc = $user->balance;
    
        if ($request->amount > $balanceInBtc->balance) {
            return back()->withErrors(['message' => 'Saldo insuficiente para realizar o saque.']);
        }
    
        $balanceInBtc->balance -= $request->amount;
        $balanceInBtc->save();
    
        $details = $this->determineWithdrawalDetails($request);
    
        $withdrawal = new Withdrawal([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
            'requested_at' => now(),
            'method' => $request->input('method'),
            'details' => $details,
        ]);
    
        $withdrawal->save();
    
        return back()->with('success', 'Saque solicitado com sucesso. Aguarde a aprovação.');
    }
    
    
    

private function determineWithdrawalDetails(Request $request)
{
    switch ($request->input('method')) {
        case 'crypto':
            return 'Endereço da carteira: ' . $request->input('wallet-address');
        case 'bank':
            return 'Dados bancários: Banco - ' . $request->input('bank-name') . ', CPF/CNPJ - ' . $request->input('account-holder-cpf-cnpj') . ', Agência - ' . $request->input('agency-number') . ', Conta - ' . $request->input('account-number') . ', Tipo - ' . $request->input('account-type');
        case 'pix':
            return 'Chave Pix: ' . $request->input('pix-key');
        default:
            return '';
    }
}



}
