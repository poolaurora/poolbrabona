<div class="lg:hidden">
    <div class="w-64 fixed bg-gray-900 shadow h-screen z-50 flex-col justify-between transform -translate-x-full left-0 transition-transform duration-300" id="mobileSidebar">
        <div class="px-8">
            <div class="w-full flex items-center justify-center p-2">
                <img class="h-16 w-16" src="/images/logo-no-bg.png" alt="logo image placeholder">
            </div>
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="
                        @if(request()->routeIs('dashboard'))
                            text-emerald-400
                        @endif
                        ">
                            <i class="fa-solid fa-house mr-3 text-xl"></i>
                            <span class="text-lg">Dashboard</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Inicio</a></li>
                        <!-- Additional options can be added here -->
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="@if(request()->routeIs('saques.*'))
                            text-emerald-400
                        @endif">
                            <i class="fa-solid fa-sack-dollar mr-3 text-xl"></i>
                            <span class="text-lg">Saques</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('saques.efetuar') }}" class="
                        
                        @if(request()->routeIs('saques.efetuar'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                        @endif    
                            
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Efetuar saque</a></li>
                        <li><a href="{{ route('saques.historico') }}" class="
                        
                        @if(request()->routeIs('saques.historico'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                        @endif    
                            
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Histórico De Saques</a></li>
                        <!-- Additional options can be added here -->
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="@if(request()->routeIs('maquinas.*'))
                            text-emerald-400
                            @endif">
                            <i class="fa-solid fa-hard-drive mr-3 text-xl"></i>
                            <span class="text-lg">Maquinas</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('maquinas.menu') }}" class="
                            @if(request()->routeIs('maquinas.menu'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Minhas Máquinas</a></li>
                        @if(auth()->user()->roles->isEmpty())
                        <li class="flex gap-2 items-center"><i class="fa-solid fa-lock text-gray-600 cursor-not-allowed	"></i><a disabled href="#" class="cursor-not-allowed text-gray-600 block px-5 py-3 rounded-md">Adquirir Maquinas</a></li>
                        @else
                        <li><a href="{{ route('maquinas.adicionar') }}" class="
                            @if(request()->routeIs('maquinas.adicionar'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Adquirir Maquinas</a></li>
                        @endif
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div
                        class="
                        @if(request()->routeIs('salas.*'))
                            text-emerald-400
                            @endif">
                            <i class="fa-solid fa-server mr-3 text-xl"></i>
                            <span class="text-lg">Salas</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('salas.menu') }}" class="
                            @if(request()->routeIs('salas.menu'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Lobby de salas</a></li>
                        @if(auth()->user()->roles->isEmpty())
                        <li class="flex gap-2 items-center"><i class="fa-solid fa-lock text-gray-600 cursor-not-allowed	"></i><a disabled href="#" class="cursor-not-allowed text-gray-600 block px-5 py-3 rounded-md">Salas Ativas</a></li>
                        @else
                        <li><a href="{{ route('salas.active') }}" class="
                            @if(request()->routeIs('salas.active'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Salas Ativas</a></li>                            
                        @endif
                        @if(auth()->user()->roles->isEmpty())
                        <li class="flex gap-2 items-center"><i class="fa-solid fa-lock text-gray-600 cursor-not-allowed	"></i><a disabled href="#" class="cursor-not-allowed text-gray-600 block px-5 py-3 rounded-md">Criar Sala</a></li>
                        @else
                        <li><a href="{{ route('salas.create') }}" class="
                            @if(request()->routeIs('salas.create'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Criar Sala</a></li>
                        @endif
                        <!-- Additional options can be added here -->
                    
                    
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="@if(request()->routeIs('maquinas.*'))
                            text-emerald-400
                            @endif">
                            <i class="fa-solid fa-book mr-3 text-xl"></i>
                            <span class="text-lg">Tutoriais</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('tutoriais.menu') }}" class="
                            @if(request()->routeIs('tutoriais.menu'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Ver tutoriais</a></li>
                    </ul>
                </li>

                @role('admin')
                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div
                        class="
                        @if(request()->routeIs('admin.*'))
                            text-red-400
                            @endif">
                            <i class="fa-solid fa-shield-halved mr-3 text-xl"></i>
                            <span class="text-lg">Admin</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('admin.users') }}" class="
                            @if(request()->routeIs('admin.users'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Usuários</a></li>
                        <li><a href="{{ route('admin.maquinas') }}" class="
                            @if(request()->routeIs('admin.maquinas'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Máquinas</a></li>
                        <li><a href="{{ route('admin.salas') }}" class="
                            @if(request()->routeIs('admin.salas'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Salas</a></li>
                        <li><a href="{{ route('admin.saques') }}" class="
                            @if(request()->routeIs('admin.saques'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Saques</a></li>
                        <li><a href="{{ route('admin.chat') }}" class="
                            @if(request()->routeIs('admin.chat'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Chat</a></li>    
                        <!-- Additional options can be added here -->
                    
                    
                    </ul>
                </li>
                @endrole
                <!-- Replace with actual list items -->
                <!-- ... -->
            </ul>
        </div>
        <div class="px-8 border-t border-gray-700">
            <div class="flex items-center justify-between pt-6">
                <div class="flex items-center">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile placeholder" class="rounded-full h-10 w-10 object-cover">
                    <p class="text-gray-300 text-sm mx-3">{{ Auth::user()->username }}</p>
                </div>
              </div>
            <!-- Settings menu item -->
            <div>
              <li>
                  <button class="flex items-center justify-between w-full text-base font-normal p-2 text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                      <div
                      class="
                      @if(request()->routeIs('me.*'))
                          text-emerald-400
                          @endif">
                          <i class="fa-solid fa-gear mr-3 text-xl"></i>
                          <span class="text-lg">Configurações</span>
                      </div>
                      <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                  </button>
                  <!-- Submenu, hidden by default -->
                  <ul class="hidden pl-2 w-full mt-2">
                      <li><a href="{{ route('me.profile') }}" class="
                          @if(request()->routeIs('me.profile'))
                          text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                          @endif    
                      text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Perfil</a></li>
                      
                      <li><a href="{{ route('me.extrato') }}" class="
                          @if(request()->routeIs('me.extrato'))
                          text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                          @endif    
                      text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Extrato</a></li>
                      <!-- Additional options can be added here -->
                  
                  
                  </ul>
              </li>
            </div>
            <!-- Template pages menu item -->
            <div class="flex items-center justify-center mt-5 mb-5">
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte') || auth()->user()->hasRole('shark'))
                  <div class="bg-gray-600 text-gray-100 px-5 py-3 rounded hover:bg-gray-500 focus:outline-none text-sm">
                     JA ESTÁ NO UPGRADE MÁXIMO
                    </div>
                @elseif(auth()->user()->hasRole('lion') || auth()->user()->hasRole('bear'))
                <form action="{{ route('me.upgrade') }}" method="POST">
                @csrf
                <button class="bg-emerald-600 font-bold text-gray-100 px-5 py-3 rounded hover:bg-emerald-500 focus:outline-none text-sm">
                     FAÇA O UPGRADE DO SEU PLANO
                  </button>
                </form>
                @else
                <a href="{{ env('APP_URL') . '/#plans' }}" class="bg-red-600 text-gray-100 px-5 py-3 font-bold text-center rounded hover:bg-red-500 focus:outline-none text-sm">
                     ADQUIRA UM PLANO
                </a>
                @endif  
            </div>
        </div>
        
  </div>
    
    <div class="fixed bottom-0 left-0 p-4 z-50 transition-transform duration-300" id="buttonSidebar">
        <div class="rounded-lg bg-gray-800 text-center p-4 flex justify-center items-center cursor-pointer" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars text-emerald-600 font-bold"></i>
        </div>
    </div>
    
</div>



<!-- DESKTOP SIDEBAR -->
<div class="md:hidden lg:flex">
    <div class="w-64 fixed bg-gray-900 shadow h-screen flex-col justify-between hidden sm:flex border-r border-gray-800">
        <div class="px-8">
            <div class="w-full flex items-center justify-center p-2">
                <img class="h-16 w-16" src="/images/logo-no-bg.png" alt="">
            </div>
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="
                        @if(request()->routeIs('dashboard'))
                            text-emerald-400
                        @endif
                        ">
                            <i class="fa-solid fa-house mr-3 text-xl"></i>
                            <span class="text-lg">Dashboard</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Inicio</a></li>
                        <!-- Additional options can be added here -->
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="@if(request()->routeIs('saques.*'))
                            text-emerald-400
                        @endif">
                            <i class="fa-solid fa-sack-dollar mr-3 text-xl"></i>
                            <span class="text-lg">Saques</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('saques.efetuar') }}" class="
                        
                        @if(request()->routeIs('saques.efetuar'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                        @endif    
                            
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Efetuar saque</a></li>
                        <li><a href="{{ route('saques.historico') }}" class="
                        
                        @if(request()->routeIs('saques.historico'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                        @endif    
                            
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Histórico De Saques</a></li>
                        <!-- Additional options can be added here -->
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="@if(request()->routeIs('maquinas.*'))
                            text-emerald-400
                            @endif">
                            <i class="fa-solid fa-hard-drive mr-3 text-xl"></i>
                            <span class="text-lg">Maquinas</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('maquinas.menu') }}" class="
                            @if(request()->routeIs('maquinas.menu'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Minhas Máquinas</a></li>
                        @if(auth()->user()->roles->isEmpty())
                        <li class="flex gap-2 items-center"><i class="fa-solid fa-lock text-gray-600 cursor-not-allowed	"></i><a disabled href="#" class="cursor-not-allowed text-gray-600 block px-5 py-3 rounded-md">Adquirir Maquinas</a></li>
                        @else
                        <li><a href="{{ route('maquinas.adicionar') }}" class="
                            @if(request()->routeIs('maquinas.adicionar'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Adquirir Maquinas</a></li>
                        @endif
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div
                        class="
                        @if(request()->routeIs('salas.*'))
                            text-emerald-400
                            @endif">
                            <i class="fa-solid fa-server mr-3 text-xl"></i>
                            <span class="text-lg">Salas</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('salas.menu') }}" class="
                            @if(request()->routeIs('salas.menu'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Lobby de salas</a></li>
                        @if(auth()->user()->roles->isEmpty())
                        <li class="flex gap-2 items-center"><i class="fa-solid fa-lock text-gray-600 cursor-not-allowed	"></i><a disabled href="#" class="cursor-not-allowed text-gray-600 block px-5 py-3 rounded-md">Salas Ativas</a></li>
                        @else
                        <li><a href="{{ route('salas.active') }}" class="
                            @if(request()->routeIs('salas.active'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Salas Ativas</a></li>                            
                        @endif
                        @if(auth()->user()->roles->isEmpty())
                        <li class="flex gap-2 items-center"><i class="fa-solid fa-lock text-gray-600 cursor-not-allowed	"></i><a disabled href="#" class="cursor-not-allowed text-gray-600 block px-5 py-3 rounded-md">Criar Sala</a></li>
                        @else
                        <li><a href="{{ route('salas.create') }}" class="
                            @if(request()->routeIs('salas.create'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Criar Sala</a></li>
                        @endif
                        <!-- Additional options can be added here -->
                    
                    
                    </ul>
                </li>

                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div class="@if(request()->routeIs('tutoriais.*'))
                            text-emerald-400
                            @endif">
                            <i class="fa-solid fa-book mr-3 text-xl"></i>
                            <span class="text-lg">Tutoriais</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('tutoriais.menu') }}" class="
                            @if(request()->routeIs('tutoriais.menu'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Ver tutoriais</a></li>
                    </ul>
                </li>

                @role('admin')
                <li>
                    <button class="flex items-center justify-between p-2 w-full text-base font-normal text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div
                        class="
                        @if(request()->routeIs('admin.*'))
                            text-red-400
                            @endif">
                            <i class="fa-solid fa-shield-halved mr-3 text-xl"></i>
                            <span class="text-lg">Admin</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('admin.users') }}" class="
                            @if(request()->routeIs('admin.users'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Usuários</a></li>
                        <li><a href="{{ route('admin.maquinas') }}" class="
                            @if(request()->routeIs('admin.maquinas'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Máquinas</a></li>
                        <li><a href="{{ route('admin.salas') }}" class="
                            @if(request()->routeIs('admin.salas'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Salas</a></li>
                        <li><a href="{{ route('admin.saques') }}" class="
                            @if(request()->routeIs('admin.saques'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Saques</a></li>
                        <li><a href="{{ route('admin.chat') }}" class="
                            @if(request()->routeIs('admin.chat'))
                            text-white bg-gray-300/[.06] border-red-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-red-500 hover:border-l-4 rounded-md">Chat</a></li>    
                        <!-- Additional options can be added here -->
                    
                    
                    </ul>
                </li>
                @endrole
                <!-- Replace with actual list items -->
                <!-- ... -->
            </ul>
        </div>
        <div class="px-8 border-t border-gray-700">
              <div class="flex items-center justify-between pt-6">
                  <div class="flex items-center">
                      <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile placeholder" class="rounded-full h-10 w-10 object-cover">
                      <p class="text-gray-300 text-sm mx-3">{{ Auth::user()->username }}</p>
                  </div>
                </div>
              <!-- Settings menu item -->
              <div>
                <li>
                    <button class="flex items-center justify-between w-full text-base font-normal p-2 text-gray-300 rounded-lg transition duration-75 group hover:bg-gray-700 hover:text-white " onclick="toggleSubMenu(event)">
                        <div
                        class="
                        @if(request()->routeIs('me.*'))
                            text-emerald-400
                            @endif">
                            <i class="fa-solid fa-gear mr-3 text-xl"></i>
                            <span class="text-lg">Configurações</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                    </button>
                    <!-- Submenu, hidden by default -->
                    <ul class="hidden pl-2 w-full mt-2">
                        <li><a href="{{ route('me.profile') }}" class="
                            @if(request()->routeIs('me.profile'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Perfil</a></li>
                        
                        <li><a href="{{ route('me.extrato') }}" class="
                            @if(request()->routeIs('me.extrato'))
                            text-white bg-gray-300/[.06] border-emerald-500 border-l-4
                            @endif    
                        text-gray-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Extrato</a></li>
                        
                        
                        <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button href="" class="
                                text-red-300 hover:text-white block px-5 py-3 hover:bg-gray-300/[.06] hover:border-emerald-500 hover:border-l-4 rounded-md">Log Out</button>
                            </form>
                        </li>
                        
                        <!-- Additional options can be added here -->
                    
                    
                    </ul>
                </li>
              </div>
              <!-- Template pages menu item -->
              <div class="flex items-center justify-center mt-5 mb-5">
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte') || auth()->user()->hasRole('shark'))
                  <div class="bg-gray-600 text-gray-100 px-5 py-3 rounded hover:bg-gray-500 focus:outline-none text-sm">
                     JA ESTÁ NO UPGRADE MÁXIMO
                    </div>
                @elseif(auth()->user()->hasRole('lion') || auth()->user()->hasRole('bear'))
                <form action="{{ route('me.upgrade') }}" method="POST">
                @csrf
                <button class="bg-emerald-600 font-bold text-gray-100 px-5 py-3 rounded hover:bg-emerald-500 focus:outline-none text-sm">
                     FAÇA O UPGRADE DO SEU PLANO
                  </button>
                </form>
                @else
                <a href="{{ env('APP_URL') . '/#plans' }}" class="bg-red-600 text-gray-100 px-5 py-3 font-bold text-center rounded hover:bg-red-500 focus:outline-none text-sm">
                     ADQUIRA UM PLANO
                </a>
                @endif  
              </div>
          </div>
          
    </div>
</div>

<script>
    function toggleSubMenu(event) {
        // Prevent the default action
        event.preventDefault();
        
        // Find the next element which is the submenu
        const subMenu = event.currentTarget.nextElementSibling;

        // Toggle the 'hidden' class on the submenu
        subMenu.classList.toggle('hidden');
    }
</script>