<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CryptoCurrencyService;

use App\Models\Balance;
use App\Models\Withdrawal;
use App\Models\MiningMachine;
use App\Models\MiningRoom;
use App\Models\User;
use App\Models\TransactionHistory;
use App\Models\UserContribution;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
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

    public function index()
    {
        $btcDetails = $this->cryptoService->getBtcDetails();
        $user = auth()->user();
        
        // Aqui é assegurado que a consulta é executada e obtemos uma coleção de máquinas
        $machines = MiningMachine::where('user_id', $user->id)->get();
    
        // Conta o número total de máquinas. Não é necessário usar sum() a menos que esteja somando um valor específico.
        $totalMachines = $machines->count();
    
        // Obtém o saldo do usuário ou define como null caso não exista
         $balance = $user->balance()->first();
         // Recupera as salas ativas em que o usuário está participando
         $miningRooms = MiningRoom::with('user')->where('end_date', '>', now())->take(4)->get();

         $machines = $user->miningMachines()->take(3)->get();

         
         $price = $btcDetails['price'];
        $bitcoinPrice = floatval(str_replace(',', '.', str_replace('.', '', substr($price, 3))));

         $year = now()->year;
        $monthOfInterest = 3; // Mês de março

    // Assumindo que $bitcoinPrice é um valor numérico adequado para multiplicação.
    $dailyBalances = $user->dailyBalances()
        ->select(
            DB::raw('SUM(balance) as total_balance'),
            DB::raw('DAY(date) as day')
        )
        ->whereYear('date', $year)
        ->whereMonth('date', $monthOfInterest)
        ->groupBy('day')
        ->orderBy('day')
        ->get()
        ->mapWithKeys(function ($item) use ($bitcoinPrice) {
            // Convertendo cada saldo do dia para reais multiplicando pelo preço do Bitcoin.
            $totalInReais = floatval($item->total_balance) * $bitcoinPrice;
            // A chave é o dia e o valor é o saldo convertido para reais.
            return [$item->day => $totalInReais];
        });

        $richestUsers = User::with('balance')
                        ->get()
                        ->take(5)
                        ->sortByDesc(function($user) {
                            return $user->balance->balance;
                        });

        return view('dashboard', compact('btcDetails', 'balance', 'machines', 'totalMachines', 'miningRooms', 'machines', 'dailyBalances', 'bitcoinPrice', 'richestUsers'));
    }
    
    

    public function SaquesIndex()
    {
        $btcDetails = $this->cryptoService->getBtcDetails();
        $user = auth()->user();
    
        // Obtém o saldo do usuário ou define como null caso não exista
        $balance = $user->balance()->first();
    
        return view('saques.efetuar', compact('btcDetails', 'balance'));
    }

    public function HistoryIndex()
    {
        // Obtém o usuário logado
        $user = Auth::user();
    
        // Recupera os saques relacionados ao usuário logado e ordena-os do mais recente para o mais antigo
        $withdrawals = $user->withdrawals()->orderBy('created_at', 'desc')->get();
    
        // Passa os saques para a view
        return view('saques.historico', compact('withdrawals'));
    }
    

    public function indexMachines()
    {
        // Obtém o usuário autenticado
        $user = auth()->user();

        // Se existe um usuário logado, busca suas máquinas
        if ($user) {
            // Recupera todas as máquinas de mineração associadas ao usuário logado
            $machines = $user->miningMachines()->get();
        } else {
            // Define máquinas como uma coleção vazia se nenhum usuário estiver logado
            $machines = collect();
        }

        // Passa as máquinas para a view
        return view('maquinas.menu', compact('machines'));
    }

    public function IndexCreateSalas(){
        

        return view('salas.criar');
    }


    public function IndexSalas()
    {
        // Busca todas as salas de mineração que ainda estão ativas
        $miningRooms = MiningRoom::where('end_date', '>', now())->get();

        // Passa as salas ativas para a view
        return view('salas.menu', ['miningRooms' => $miningRooms]);
    }



    public function Extrato()
    {
        // Obtém o ID do usuário logado
        $userId = Auth::id();

        // Recupera as transações relacionadas ao usuário logado e ordena por data de criação
        $transactions = TransactionHistory::where('user_id', $userId)
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        // Passa as transações para a view
        return view('me.extrato', compact('transactions'));
    }

    public function Profile()
    {
        return view('profile.show');
    }


    public function IndexActiveSalas()
    {
        // Obtém o ID do usuário logado
        $userId = Auth::id();

        // Busca por contribuições do usuário logado
        $userContributions = UserContribution::where('user_id', $userId)->get();
        
        // Coleta os IDs das salas a partir das contribuições do usuário
        $roomIds = $userContributions->pluck('mining_room_id')->unique();

        // Recupera as salas ativas em que o usuário está participando
        // Verifica se o end_date é maior (posterior) que a data e hora atual
        $miningRooms = MiningRoom::whereIn('id', $roomIds)
                                ->where('end_date', '>', now())
                                ->get();

        return view('salas.ativas', ['miningRooms' => $miningRooms]);
    }


    public function TutoriaisIndex(){
        

        return view('tutoriais.tutoriais');
    }


}
