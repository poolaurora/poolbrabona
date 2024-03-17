<x-app-layout>
<div class="flex flex-col items-left max-w-max lg:w-7/12 w-11/12">
        <div class="p-8 mt-4 flex flex-col items-left text-center lg:text-left bg-gradient-to-b from-emerald-800 via-gray-700 to-gray-950 rounded-lg">
            <h1 class="text-white font-bold text-xl lg:text-3xl">Bem-vindo, {{ Auth::user()->name }}</h1>
            <span class="text-gray-300 text-md lg:text-lg">Explore a gestão de suas máquinas e ganhos com várias funcionalidades.</span>
        </div>

   <div class="p-8 flex flex-col items-center">
            

   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full"> <!-- INÍCIO FLEX CARDS -->

    <!-- Card Máquinas Ativas -->
    <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 bg-gradient-to-r from-gray-800 to-gray-900 border border-gray-700 shadow-xl rounded-lg flex flex-col p-6 hover:shadow-2xl">
        <div class="flex items-center text-blue-500 space-x-3">
            <i class="fas fa-hard-drive text-xl animate-pulse"></i>
            <span class="font-medium text-lg">Máquinas Ativas</span>
        </div>
        <div class="mt-4 text-center">
            <h2 class="text-white font-semibold text-2xl animate-pulse">{{ $totalMachines }} Máquinas</h2>
        </div>
    </div>

    <!-- Card Horas Online -->
    <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 bg-gradient-to-r from-gray-800 to-gray-900 border border-gray-700 shadow-xl rounded-lg flex flex-col p-6 hover:shadow-2xl">
        <div class="flex items-center text-white space-x-3">
            <i class="fa-solid fa-user text-xl animate-pulse"></i>
            <span class="font-medium text-lg">Plano Ativo:</span>
        </div>
        @if(auth()->user()->hasRole('admin'))
        <div class="mt-4 text-center flex justify-center">
            <div class="p-2 rounded-lg bg-red-600/[.50] text-center">
                <span class="text-red-500 text-xl">Admin</span>
            </div>
        </div>
        @elseif(auth()->user()->hasRole('suporte'))
        <div class="mt-4 text-center flex justify-center">
            <div class="p-2 rounded-lg bg-yellow-600/[.50] text-center">
                <span class="text-yellow-500 text-xl">Suporte</span>
            </div>
        </div>
        @elseif(auth()->user()->hasRole('shark'))
        <div class="mt-4 text-center flex justify-center">
            <div class="p-2 rounded-lg bg-emerald-600/[.50] text-center">
                <span class="text-emerald-500 text-xl">Shark</span>
            </div>
        </div>
        @elseif(auth()->user()->hasRole('lion'))
        <div class="mt-4 text-center flex justify-center">
            <div class="p-2 rounded-lg bg-orange-600/[.50] text-center">
                <span class="text-orange-500 text-xl">Lion</span>
            </div>
        </div>
        @elseif(auth()->user()->hasRole('bear'))
        <div class="mt-4 text-center flex justify-center">
            <div class="p-2 rounded-lg bg-blue-600/[.50] text-center">
                <span class="text-blue-500 text-xl">Bear</span>
            </div>
        </div>
        @else
        <div class="mt-4 text-center flex justify-center">
            <div class="p-2 rounded-lg bg-gray-600/[.50] text-center">
                <span class="text-gray-500 text-xl">Grátis</span>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Card Bitcoin -->
    <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 bg-gradient-to-r from-gray-800 to-gray-900 border border-gray-700 shadow-xl rounded-lg flex flex-col p-6 hover:shadow-2xl">
        <div class="flex items-center text-yellow-500 space-x-3">
            <i class="fa-brands fa-bitcoin text-xl animate-pulse"></i>
            <span class="font-medium text-lg">Bitcoin</span>
        </div>
        <div class="mt-4 text-center">
            <h2 class="text-white font-semibold text-2xl animate-pulse">{{ $btcDetails['price'] }}</h2>
            <div class="mt-2 inline-flex items-center {{ $btcDetails['change_24hr'] > 0 ? 'text-green-500' : 'text-red-500' }}">
                <span class="text-md">{{ $btcDetails['change_24hr'] }}%</span>
                <i class="fa-solid {{ $btcDetails['change_24hr'] > 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} ml-2 {{ $btcDetails['change_24hr'] > 0 ? 'animate-bounce' : 'animate-bounce' }}"></i>
            </div>
        </div>
    </div>

</div><!-- FIM FLEX CARDS -->

 @php
 // Extrai e converte o preço do Bitcoin para um float
// Remove 'R$ ', substitui '.' por nada e ',' por '.' para converter corretamente para float
$price = (float)str_replace('.', '', substr($btcDetails['price'], 3));
$price = (float)str_replace(',', '.', $price);

// A quantidade de Bitcoin do usuário já está em formato numérico adequado
$bitcoinAmount = (float)$balance->balance;

// Calcula o valor total em reais
$totalValueInBRL = $price * $bitcoinAmount;
@endphp  

<div class="mt-9 px-4 py-8 bg-gray-800 border border-gray-700 shadow-xl rounded-lg w-full">
  <div class="flex flex-col lg:flex-row w-full bg-gray-850 rounded-lg">
    <!-- Seção de Informações do Saldo -->
    <div class="flex-1 p-4 text-white">
      <h2 class="text-xl text-gray-400">Saldo Total</h2>
      <div class="mt-2 flex items-center justify-between lg:justify-start lg:gap-8">
        <div>
          <h1 class="text-3xl font-bold text-white">R$ {{ number_format($totalValueInBRL, 2, ',', '.') }}</h1>
          <p class="text-lg text-gray-400">BTC {{ $balance->balance }}</p>
        </div>
      </div>
    </div>

    <!-- Toggle Buttons for Revenue and Expenses -->
    <div class="flex-1 mt-6 lg:mt-0 p-4">
      <div class="flex gap-4 justify-center lg:justify-end">
        <button class="px-4 py-2 text-md text-white bg-green-600 rounded-lg flex items-center focus:outline-none hover:bg-green-700 transition-colors">
          <div class="h-4 w-4 bg-green-300 rounded-full mr-2"></div>
          Entradas
        </button>
      </div>
    </div>
  </div>

  <!-- Gráfico -->
  <div class="responsive-container" style="position: relative; height: 40vh; width: 100%">
            <canvas id="myChart"></canvas>
 </div>

</div>


    
<div class="flex flex-col items-center text-center bg-gray-800 border border-gray-700 shadow-2xl rounded-xl w-full p-8 mt-4">
    <h1 class="text-xl sm:text-3xl text-white font-bold mb-6">Salas de Mineração Online</h1>
    <p class="text-gray-300 sm:text-lg mb-6">Explore e junte-se às salas de mineração compartilhada.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 p-4">
    @forelse ($miningRooms as $room)
    @php
    $isContributor = $room->contributors->contains('id', auth()->user()->id);
    @endphp
    <div class="bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <div class="p-4 bg-gray-700 rounded-t-lg">
            <h3 class="text-2xl text-white font-bold mb-2">Sala de {{ $room->user->username }}</h3>
            <p class="text-gray-400 mb-4">Taxa de mineração: <span class="text-blue-400 font-bold">{{ $room->total_power }} TH/s</span></p>
        </div>
        <div class="px-4 py-2 bg-gray-800 rounded-b-lg">
            <form action="{{ route('salas.join', ['id' => $room->id]) }}" method="POST">
                @csrf
                @if(auth()->user()->roles->isEmpty())
                <button disabled type="submit" class="w-full bg-gray-600 text-white py-2 rounded-md font-bold uppercase tracking-wider transition-colors duration-200" {{ $isContributor ? 'disabled' : '' }}>
                    Você precisa de um plano
                </button>
                @else
                <button type="submit" class="w-full {{ $isContributor ? 'bg-gray-600' : 'bg-emerald-500 hover:bg-emerald-600' }} text-white py-2 rounded-md font-bold uppercase tracking-wider transition-colors duration-200" {{ $isContributor ? 'disabled' : '' }}>
                    {{ $isContributor ? 'Participando' : 'Entrar na sala' }}
                </button>
                @endif
            </form>
        </div>
        <div class="p-4 bg-gray-700 rounded-b-lg">
            <h4 class="text-gray-300 text-sm mb-2">Participantes:</h4>
            <div class="flex -space-x-2 overflow-hidden">
                @forelse ($room->contributors as $participant)
                <img class="inline-block h-8 w-8 rounded-full border-2 border-gray-700 object-cover" src="{{ $participant->profile_photo_url }}" alt="{{ $participant->name }}" title="{{ $participant->name }}">
                @empty
                <p class="text-gray-500 text-xs">A Sala está vazia</p>
                @endforelse
            </div>
        </div>
    </div>
@empty
    <p class="text-gray-400 text-md text-center">Não possui nenhuma sala online no momento.</p>
@endforelse

    </div>
</div>



<div class="flex flex-col items-center text-center bg-gray-800 border border-gray-700 rounded-lg w-full p-8 mt-4">
    <h1 class="text-white font-bold text-3xl">Suas Máquinas de Mineração</h1>
    <span class="text-gray-400 text-sm lg:text-lg mb-4">Veja aqui o total de máquinas de mineração que você possui.</span>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Card 1 -->
        @forelse($machines as $machine)
    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
        <img class="w-full h-30 object-cover" src="/images/machine.png" alt="Imagem da máquina">
        <!-- Card Body -->
        <div class="p-4 bg-black bg-opacity-70">
            <div class="absolute top-0 right-0 pt-2 pr-2">
                <span class="bg-yellow-500 text-white text-lg font-bold px-2 py-1 rounded">Lv. {{ $machine->level }}</span>
            </div>
            <div class="mt-12">
                <h3 class="text-white text-lg font-semibold mb-2">Informações da Máquina</h3>
                <div class="text-white">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-300">Bateria:</span>
                        <span class="font-bold">{{ $machine->energy }}%</span>
                    </div>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-300">Total Minerado:</span>
                        <span class="font-bold">{{ $machine->bitcoins_mined }} BTC</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">ID da Máquina:</span>
                        <span class="font-bold">{{ $machine->id }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- CARD 01 FIM -->
@empty
    <div class="text-center">
        <p class="text-white text-xl">Não há máquinas disponíveis no momento.</p>
    </div>
@endforelse
    </div><!-- FIM MAQUINAS AREA -->
</div><!-- FIM MAQUINAS -->

        
<div class="flex flex-col items-center text-center bg-gray-800 border border-gray-600 shadow-xl rounded-lg w-full p-4 sm:p-8 mt-8">
    <h3 class="text-white text-2xl sm:text-3xl font-bold mb-4 sm:mb-6">Top Usuários Mais Ricos</h3>
    <ul class="w-full">
    {{-- Suponha que $richestUsers seja passado para a view e contenha os usuários e seus saldos ordenados --}}
    @php $position = 1; @endphp
@foreach($richestUsers as $user)
    <li class="flex flex-col sm:flex-row items-center justify-between text-white py-3 border-b border-gray-500/[.30]">
        <div class="flex items-center mb-3 sm:mb-0 space-x-4">
            <img class="h-12 w-12 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="Avatar de {{ $user->name }}">
            <div class="flex flex-col items-center sm:items-start">
                <span class="font-bold text-lg">{{ $user->name }}</span>
                <div class="flex items-center justify-center sm:justify-start text-sm {{ $position === 1 ? 'text-yellow-400' : ($position === 2 ? 'text-gray-300' : 'text-amber-500') }}">
                    <i class="fas {{ $position === 1 ? 'fa-crown' : 'fa-medal' }} mr-2"></i>
                    <span>{{ $position }}º Lugar</span>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap gap-4 justify-center sm:justify-start text-sm md:text-lg font-semibold">
            <span class="flex items-center text-orange-400">
                <i class="fa-brands fa-bitcoin mr-2"></i>
                {{ $user->balance->balance }} BTC
            </span>
            <span class="flex items-center text-purple-500">
                <i class="fa-solid fa-hard-drive mr-2"></i>
                {{ $user->miningMachines->count() }} MÁQUINAS
            </span>
        </div>
    </li>
    @php $position++; @endphp
@endforeach


    </ul>
</div>

        
         
    
    </div>
</div>  


    

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
   // Supondo que dailyBalancesData seja passado corretamente para o JavaScript
const dailyBalancesData = @json($dailyBalances);

// Identificar o primeiro dia de faturamento
const firstDayOfEarning = Object.keys(dailyBalancesData).shift();

// Gerar rótulos começando do primeiro dia de faturamento até o fim do mês
const labels = Array.from({ length: 31 - firstDayOfEarning + 1 }, (_, i) => moment(`${i + firstDayOfEarning}-03-${new Date().getFullYear()}`, 'DD-MM-YYYY').format('DD MMM'));

// Filtrar os dados para incluir apenas a partir do primeiro dia de faturamento
const data = Object.keys(dailyBalancesData).map(day => dailyBalancesData[day]);

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: Object.keys(dailyBalancesData).map(day => `Dia ${day}`),
        datasets: [{
            label: 'Saldo em Reais',
            data: data,
            backgroundColor: 'rgba(22, 163, 74, 0.2)',
            borderColor: '#16a34a',
            borderWidth: 3,
            fill: true
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = context.dataset.label || '';

                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            label += new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(context.parsed.y);
                        }
                        return label;
                    }
                }
            },
            legend: {
                labels: {
                    font: {
                        size: 14
                    }
                }
            }
        }
    }
});

    </script>
</x-app-layout>

