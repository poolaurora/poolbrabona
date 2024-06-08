<x-app-layout>
<div class="overflow-hidden">
    <div class="w-full h-full bg-gray-800 bg-opacity-95 fixed top-0 left-0 flex items-center justify-center">
            <div class="bg-gray-900 p-6 rounded-lg text-white text-xl w-5/12 text-center">
                <h1 class="p-4 text-2xl">Em Desenvolvimento</h1>
                <span class="text-gray-400">O sistema de afiliados começou a ser desenvolvido! Em breve todos nossos usuários que tiverem um plano poderão ganhar recompensas indicando outras pessoas.</span>
            </div>
        </div>    
    <div class="py-12" x-data>
        <div class="lg:w-8/12 w-10/12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 text-white p-8 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-emerald-400 mb-6">Inventário de Recompensas</h1>
                <p class="mb-4">
                    Aqui você pode ver as recompensas disponíveis para resgate. Clique no botão "Resgatar" para obter seu bônus.
                </p>
                @foreach($recompensas as $recompensa)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                    @if($recompensa->item_purchased === 'rec1')
                    <!-- Cartão de Recompensa 1 -->
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <img src="https://aurora-miner.b-cdn.net/images/machine.webp" alt="Maquina de Mineração Level 2" class="w-full h-92 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-emerald-400 mb-2">Maquina de Mineração Level 2</h2>
                            <p class="text-gray-300 mb-2">Ao resgatar essa recompensa você irá ganhar uma maquina de mineração level 2 com 100% de energia</p>
                            <p class="text-gray-400 mb-4">Recompensa recebido por giovan_242</p>
                            <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Resgatar
                            </button>
                        </div>
                    </div>
                    @elseif($recompensa->item_purchased === 'rec2')
                    <!-- Cartão de Recompensa 2 -->
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <img src="https://aurora-miner.b-cdn.net/images/energy.png" alt="Recarga de maquina completa" class="w-full h-92 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-emerald-400 mb-2">Recarga de Maquina</h2>
                            <p class="text-gray-300 mb-2">Ao resgatar essa recompensa você irá ganhar recarga completa para sua maquina com menos energia</p>
                            <p class="text-gray-400 mb-4">Recompensa recebido por giovan_242</p>
                            <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Resgatar
                            </button>
                        </div>
                    </div>
                    @elseif($recompensa->item_purchased === 'rec3')
                    <!-- Cartão de Recompensa 1 -->
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <img src="https://aurora-miner.b-cdn.net/images/machine.webp" alt="Maquina de Mineração Level 2" class="w-full h-92 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-purple-400 mb-2">Sala de Mineração</h2>
                            <p class="text-gray-300 mb-2">Ao resgatar essa recompensa você irá ganhar uma sala de mineração compatilhada com duração de 30 minutos para 5 pessoas</p>
                            <p class="text-gray-400 mb-4">Recompensa recebido por giovan_242</p>
                            <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Resgatar
                            </button>
                        </div>
                    </div>
                    @endif
                    <!-- Repita o bloco acima para mais recompensas -->
                </div>
                @endforeach
                    @if($recompensas->count() < 1)
                    <div class="flex w-full justify-center p-4 text-gray-500">
                        <span>Nenhuma Recompensa encontrada</span>
                    </div>
                    @endif
            </div>
        </div>
    </div> 
</div>           
</x-app-layout>
