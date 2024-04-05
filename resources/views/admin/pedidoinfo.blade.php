<x-app-layout>
    @if(isset($pedido->payment))
    <div class="flex flex-col items-center text-center bg-gray-900 min-h-screen p-8">
        <div class="bg-opacity-90 bg-gray-800 rounded-3xl overflow-hidden shadow-xl max-w-5xl w-full p-5">
            <div class="w-full text-gray-300">
                <h2 class="text-3xl font-bold">Pedido #{{ $pedido->payment->order_id }}</h2>
                <h3 class="text-2xl mt-2 mb-4">Detalhes do Pedido</h3>

                <div class="rounded-xl bg-gray-700 p-6 mt-6 shadow-inner">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <p class="font-semibold">Nome do Cliente</p>
                            <p class="text-xl">{{ $pedido->nome }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">E-mail do Cliente</p>
                            <p class="text-xl">{{ $pedido->email }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Total do Pedido</p>
                            <p class="text-xl">
                                @if(isset(json_decode($pedido->description, true)['plan']))
                                    R${{ number_format(json_decode($pedido->description, true)['plan']['value'], 2, '.', '') }}
                                @elseif(isset(json_decode($pedido->description, true)['maquinas']))
                                    R${{ number_format(json_decode($pedido->description, true)['maquinas']['value'], 2, '.', '') }}
                                @elseif(isset(json_decode($pedido->description, true)['upgradeMaquinas']))
                                    R${{ number_format(json_decode($pedido->description, true)['upgradeMaquinas']['value'], 2, '.', '') }}
                                @elseif(isset(json_decode($pedido->description, true)['salaData']))
                                    R${{ number_format(json_decode($pedido->description, true)['salaData']['value'], 2, '.', '') }}
                                @elseif(isset(json_decode($pedido->description, true)['UpgradePlanData']))
                                    R${{ number_format(json_decode($pedido->description, true)['UpgradePlanData']['value'], 2, '.', '') }}
                                @endif</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-gray-700 p-6 mt-4 shadow-inner">
                    <div class="grid md:grid-cols-2 gap-4 text-center md:text-left">
                        <div>
                            <p class="font-semibold">Data do Pedido</p>
                            <p class="text-xl">{{ $pedido->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Status do Pedido</p>
                            <p class="text-xl">{{ $pedido->status }}</p>
                        </div>
                    </div>
                </div>

                <!-- Seção de Detalhes dos Itens do Pedido -->
                <div class="rounded-xl bg-gray-700 p-6 mt-4 shadow-inner">
                    <h4 class="text-xl font-bold mb-4">Itens do Pedido</h4>
                    @php
                  $description = json_decode($pedido->description, true);
                @endphp

            @if(isset($description['plan']))
                  <ul class="space-y-2">
                        <li class="flex justify-between text-white">
                        <span>Plano</span>
                        <span>{{ $description['plan']['name'] ?? 'N/A' }}</span>
                        </li>
                        <li class="flex justify-between text-white">
                              <span>Quantidade</span>
                              <span>{{ $description['plan']['qtd'] ?? 'N/A' }}</span>
                              </li>
                        <li class="flex justify-between text-white">
                        <span>Valor</span>
                        <span class="font-bold">R${{ number_format($description['plan']['value'] ?? 0, 2, ',', '.') }}</span>
                        </li>
                  </ul>
            @elseif(isset($description['maquinas']))
            <ul class="space-y-2">
                        <li class="flex justify-between text-white">
                        <span>Id do usuário</span>
                        <span>{{ $description['maquinas']['user_id'] ?? 'N/A' }}</span>
                        </li>
                        <li class="flex justify-between text-white">
                              <span>Quantidade</span>
                              <span>{{ $description['maquinas']['qtd'] ?? 'N/A' }}</span>
                              </li>
                        <li class="flex justify-between text-white">
                        <span>Valor</span>
                        <span class="font-bold">R${{ number_format($description['maquinas']['value'] ?? 0, 2, ',', '.') }}</span>
                        </li>
                  </ul>
                @elseif(isset($description['upgradeMaquinas']))
                <ul class="space-y-2">
                            <li class="flex justify-between text-white">
                            <span>Id do usuário</span>
                            <span>{{ $description['upgradeMaquinas']['user_id'] ?? 'N/A' }}</span>
                            </li>
                            <li class="flex justify-between text-white">
                                <span>Level atual da maquina</span>
                                <span>{{ $description['upgradeMaquinas']['level'] ?? 'N/A' }}</span>
                            </li>
                            <li class="flex justify-between text-white">
                                <span>Quantidade</span>
                                <span>{{ $description['upgradeMaquinas']['qtd'] ?? 'N/A' }}</span>
                            </li>
                            <li class="flex justify-between text-white">
                            <span>Valor</span>
                            <span class="font-bold">R${{ number_format($description['upgradeMaquinas']['value'] ?? 0, 2, ',', '.') }}</span>
                            </li>
                    </ul>
                    @elseif(isset($description['salaData']))
                    <ul class="space-y-2">
                                <li class="flex justify-between text-white">
                                <span>Id do usuário</span>
                                <span>{{ $description['salaData']['user_id'] ?? 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between text-white">
                                    <span>Capacidade da sala</span>
                                    <span>{{ $description['salaData']['capacity'] ?? 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between text-white">
                                    <span>Quantidade</span>
                                    <span>{{ $description['salaData']['qtd'] ?? 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between text-white">
                                <span>Valor</span>
                                <span class="font-bold">R${{ number_format($description['salaData']['value'] ?? 0, 2, ',', '.') }}</span>
                                </li>
                        </ul>
                        @elseif(isset($description['UpgradePlanData']))
                        <ul class="space-y-2">
                                    <li class="flex justify-between text-white">
                                    <span>Id do usuário</span>
                                    <span>{{ $description['UpgradePlanData']['user_id'] ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex justify-between text-white">
                                        <span>Quantidade</span>
                                        <span>{{ $description['UpgradePlanData']['qtd'] ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex justify-between text-white">
                                    <span>Valor</span>
                                    <span class="font-bold">R${{ number_format($description['UpgradePlanData']['value'] ?? 0, 2, ',', '.') }}</span>
                                    </li>
                            </ul>
                        @else
                            <p>Informações do plano não disponíveis.</p>
                        @endif
                </div>

                <!-- Informações do Pagador -->
                <div class="rounded-xl bg-gray-700 p-6 mt-4 shadow-inner">
                    <h4 class="text-xl font-bold mb-4">Informações do Pagador</h4>
                    <div class="text-left">
                        <p class="font-semibold">Nome: {{ $pedido->nome }}</p>
                        <p class="font-semibold">CPF/CNPJ: {{ $pedido->cpf }}</p>
                        <p class="font-semibold">E-mail: {{ $pedido->email }}</p>
                        <p class="font-semibold">Telefone: {{ $pedido->telefone }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @else
    <div class="flex flex-col items-center text-center bg-gray-900 min-h-screen p-8">
        <div class="text-3xl flex items-center justify-center text-white">
        <h1> Cliente Ainda não gerou o pedido! </h1>
        </div>
    </div>
    @endif
</x-app-layout>
