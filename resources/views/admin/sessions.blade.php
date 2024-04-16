<x-app-layout>
    <!-- Container principal com margem e ajuste de largura responsivo -->
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <!-- Box interno com padding -->
            <div class="p-6 bg-gray-900 text-gray-400 border-b border-gray-200">
                <h1 class="text-2xl font-semibold mb-4">Sessões Ativas</h1>
                <!-- Tabela com estilos de borda e espaçamento -->
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b-2 p-3 text-xs font-semibold uppercase tracking-wider">ID</th>
                            <th class="border-b-2 p-3 text-xs font-semibold uppercase tracking-wider">User ID</th>
                            <th class="border-b-2 p-3 text-xs font-semibold uppercase tracking-wider">Address</th>
                            <th class="border-b-2 p-3 text-xs font-semibold uppercase tracking-wider">User Agent</th>
                            <th class="border-b-2 p-3 text-xs font-semibold uppercase tracking-wider">Last Activity</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 text-gray-400">
                        @foreach ($sessions as $session)
                            <tr>
                                <td class="p-3 border-b">{{ $session->id }}</td>
                                <td class="p-3 border-b">{{ $session->user_id }}</td>
                                <td class="p-3 border-b">{{ $session->ip_address }}</td>
                                <td class="p-3 border-b">{{ $session->user_agent }}</td>
                                <td class="p-3 border-b">{{ date('Y-m-d H:i:s', $session->last_activity) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginação com margem no topo -->
                <div class="mt-4">
                    {{ $sessions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
