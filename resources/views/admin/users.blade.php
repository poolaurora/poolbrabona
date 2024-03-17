<x-app-layout>
    <div class="sm:rounded-lg w-7/12 mt-8 max-h-6/12 overflow-auto">
        <!-- Search bar -->
        <livewire:user-search-table />

        <!-- Formulário para atualizar a role do usuário -->
        <div class="mt-4 p-4 bg-gray-900 shadow-md sm:rounded-lg">
        <form method="POST" action="{{ route('admin.update.role') }}">
            @csrf
            <div class="mb-4">
                  <label for="user_id" class="block text-sm font-medium text-gray-500">Username do usuário</label>
                  <input type="text" id="username" name="username" class="w-full bg-gray-800 border-1 border-gray-700 rounded-lg text-gray-500" placeholder="Digite o username do usuário">
            </div>

            <div class="mb-4">
                  <label for="role" class="block text-sm font-medium text-gray-500">Cargo</label>
                  <select id="role" name="role" class="w-full bg-gray-800 border-1 border-gray-700 rounded-lg text-gray-500">
                        <option value="admin">Admin</option>
                        <option value="suporte">Suporte</option>
                        <option value="shark">Shark</option>
                        <option value="lion">Lion</option>
                        <option value="bear">Bear</option>
                        <option value="gratis">Grátis</option>
                  </select>
            </div>

            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  Atualizar Role
            </button>
            </form>
        </div>
    </div>
</x-app-layout>
