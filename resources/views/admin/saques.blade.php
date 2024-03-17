<x-app-layout>
    <div class="py-12">
        <div class="lg:w-7/12 w-5/12 mx-auto">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-300 leading-tight mb-6">
                    Listagem de Saques
                </h2>

                <div class="overflow-x-auto">
                    <table class="divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="w-1/12 px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="w-2/12 px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                                    Data
                                </th>
                                <th scope="col" class="w-3/12 px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Username
                                </th>
                                <th scope="col" class="w-3/12 px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Valor do Saque
                                </th>
                                <th scope="col" class="w-2/12 px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden md:table-cell">
                                    Documentos Verificados
                                </th>
                                <th scope="col" class="w-2/12 px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Ação
                                </th>
                                <th scope="col" class="w-1/12 px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Enviar
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach ($withdrawals as $withdrawal)
                            @php
                                    $btcPrice = (float)str_replace(['R$', '.', ','], ['', '', '.'], $btcDetails['price']);
                                    $totalValueInBRL = $btcPrice * (float)$withdrawal->amount;
                                @endphp
                                <form action="{{ route('admin.Supdate', ['id' => $withdrawal->id]) }}" method="POST">
                                @csrf
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-400">
                                        {{ $withdrawal->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400 hidden lg:table-cell">
                                        {{ $withdrawal->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400">
                                        {{ $withdrawal->user->username }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400">
                                        {{ $withdrawal->amount }} BTC<br>
                                        <span class="text-xs text-gray-500">R$ {{ number_format($totalValueInBRL, 2, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-orange-400 hidden md:table-cell">
                                        Não
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <select name="action" class="bg-gray-700 text-white rounded">
                                            <option disabled selected>Selecione</option>
                                            <option value="1">Recusar</option>
                                            <option value="2">Aprovar</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded">Enviar</button>
                                    </td>
                                </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-900 px-4 py-3 border-t border-gray-700 sm:px-6">
                    {{ $withdrawals->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
