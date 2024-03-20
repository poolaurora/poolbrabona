<div>
    <div class="sm:rounded-lg w-full">
        <!-- Search bar -->
        <div class="bg-gray-800 p-4 rounded-t-lg divide-y divide-gray-80">
            <input type="text" wire:model.debounce.500ms="searchTerm" placeholder="Pesquisar usuários..." class="bg-gray-800 text-gray-600 w-full w-full p-2 rounded-lg">
        </div>
    </div>  

    <table class="min-w-full divide-y divide-gray-800">
        <thead class="bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                    Username
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                    Plano
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                    Ações
                </th>
            </tr>
        </thead>
        <tbody class="bg-gray-900 divide-y divide-gray-800">
            <!-- Dynamically repeat this TR for each user -->
            @foreach($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-400">
                            {{ $user->username }}
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-400">{{ $user->email }}</div>
                </td>
                @if($user->hasrole('admin'))
                <td class="whitespace-nowrap">
                    <div class="p-2 bg-red-600/[0.5] text-red-500 rounded-lg">
                      <span>Admin</span>
                    </div>
                </td>
                @elseif($user->hasrole('suporte'))
                <td class="whitespace-nowrap">
                      <div class="p-2 bg-yellow-600/[0.5] text-yellow-500 rounded-lg">
                        <span>Suporte</span>
                      </div>
                  </td>
                @elseif($user->hasrole('shark'))
                <td class="whitespace-nowrap">
                      <div class="p-2 bg-emerald-600/[0.5] text-emerald-500 rounded-lg">
                        <span>Shark</span>
                      </div>
                  </td>
                  @elseif($user->hasrole('lion'))
                <td class="whitespace-nowrap">
                      <div class="p-2 bg-orange-600/[0.5] text-orange-500 rounded-lg">
                        <span>Lion</span>
                      </div>
                  </td>
                  @elseif($user->hasrole('bear'))
                  <td class="whitespace-nowrap">
                        <div class="p-2 bg-blue-600/[0.5] text-blue-500 rounded-lg">
                        <span>Bear</span>
                        </div>
                  </td>  
                  @elseif($user->hasrole('banido'))
                  <td class="whitespace-nowrap">
                        <div class="p-2 bg-red-600/[0.5] text-red-500 rounded-lg font-bold">
                        <span>Banido</span>
                        </div>
                  </td> 
                @else
                <td class="whitespace-nowrap">
                      <div class="p-2 bg-gray-600/[0.5] text-gray-400 rounded-lg">
                        <span>Grátis</span>
                      </div>
                  </td>
                @endif
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.moreInfo', ['id' => $user->id]) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Mais Informações</a>
                </td>
            </tr>
            @endforeach
            {{ $users->links() }}
            <!-- End repeat -->
        </tbody>
    </table>
</div>