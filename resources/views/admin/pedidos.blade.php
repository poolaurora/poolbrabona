<x-app-layout>
    <div class="sm:rounded-lg w-7/12 mt-8 max-h-6/12 overflow-auto">
    <div>
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        TxId
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Detalhes Do Pedido
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        CPF
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Telefone
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Data De Criação
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-800">
                @foreach($pedidos as $pedido)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-400">
                                {{ $pedido->txId }}
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        @if($pedido->status === 'paid')
                        <div class="p-2 bg-green-600/[0.5] text-green-400 rounded-lg">
                            <span>{{ $pedido->status }}</span>
                        </div>
                        @elseif($pedido->status === 'in_review')
                        <div class="p-2 bg-yellow-600/[0.5] text-yellow-400 rounded-lg">
                            <span>{{ $pedido->status }}</span>
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if(isset(json_decode($pedido->description, true)['plan']))
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>Compra de Plano</span>
                        </div>
                        @elseif(isset(json_decode($pedido->description, true)['salaData']))
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>Compra de Sala</span>
                        </div>
                        @elseif(isset(json_decode($pedido->description, true)['UpgradePlanData']))
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>Compra de Upgrade De Plano</span>
                        </div>
                        @elseif(isset(json_decode($pedido->description, true)['upgradeMaquinas']))
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>Compra de Upgrade De Maquina</span>
                        </div>
                        @elseif(isset(json_decode($pedido->description, true)['maquinas']))
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>Compra De Maquina</span>
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-400">
                                {{ $pedido->email }}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-400">
                                {{ $pedido->nome }}
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>{{ $pedido->cpf }}</span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>{{ $pedido->telefone }}</span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                            <span>{{ $pedido->created_at }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.pedidos.info', ['id' => $pedido->id]) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Mais Informações</a>
                    </td>
                </tr>
                @endforeach
                <!-- End repeat -->
            </tbody>
        </table>
    </div>
    <div>
             {{ $pedidos->links() }}
        </div>
    </div>
</x-app-layout>
