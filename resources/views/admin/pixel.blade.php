<x-app-layout>
    <!-- Container principal com margem e ajuste de largura responsivo -->
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <h1 class="text-2xl font-bold mb-4">Inserir Pixel do Facebook</h1>
                <form method="POST" action="{{ route('pixel.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300">Nome do Pixel</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full bg-gray-800 border-gray-600 text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="pixel_id" class="block text-sm font-medium text-gray-300">ID do Pixel</label>
                        <input type="text" name="pixel_id" id="pixel_id" class="mt-1 block w-full bg-gray-800 border-gray-600 text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="pixel_token" class="block text-sm font-medium text-gray-300">Token do Pixel</label>
                        <input type="text" name="pixel_token" id="pixel_token" class="mt-1 block w-full bg-gray-800 border-gray-600 text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm rounded-md" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded transition duration-300">Salvar</button>
                    </div>
                </form>

                <!-- Área de listagem dos Pixels -->
                <h2 class="text-xl font-bold mt-8 mb-4">Pixels Criados</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-800 rounded-lg">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-300">Nome do Pixel</th>
                                <th class="px-4 py-2 text-left text-gray-300">ID do Pixel</th>
                                <th class="px-4 py-2 text-left text-gray-300">Token do Pixel</th>
                                <th class="px-4 py-2 text-left text-gray-300">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pixels as $pixel)
                                <tr class="border-b border-gray-700">
                                    <td class="px-4 py-2">{{ $pixel->name }}</td>
                                    <td class="px-4 py-2">{{ $pixel->pixel_id }}</td>
                                    <td class="px-4 py-2">{{ substr($pixel->token, 0, 25) }}...</td>
                                    <td class="px-4 py-2">
                                        <!-- Aqui você pode adicionar botões de ação, como editar e excluir -->
                                        <form method="POST" action="{{ route('pixel.destroy', $pixel->id) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-500 ml-2">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">Nenhum Pixel criado ainda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
