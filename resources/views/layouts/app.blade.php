<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
        <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/1219283420207906882/1219283603884871700/logo-no-bg.png?ex=660abd58&is=65f84858&hm=3a6017d376e3dc90b48e9c9bf4315c83d42a5fc1a61b76e744009483733fcab6&" type="image/x-icon">
        <title>Aurora Miner - O melhor site de mineração do Brasil</title>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WL4RN8XZ');</script>
        <!-- End Google Tag Manager -->
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @if(request()->routeIs('dashboard'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @endif
        <script src="/js/chat.js"></script>
        <script src="/js/deleteMessage.js"></script>
        <!-- Styles -->
        @livewireStyles
    </head>
    <body 
    @if(request()->routeIs('maquinas.menu'))
        x-data="{ upgrade: false }"
        :class="{'overflow-hidden': upgrade}"
    @endif
    class="font-sans antialiased">

            @if(auth()->check() && !auth()->user()->email_verified_at)
            <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-gray-950 bg-opacity-95 z-50"></div>
                <section class="fixed z-50 top-0 left-0 w-full h-full flex justify-center items-center">
                 <div class="lg:w-1/4 w-full h-3/5 bg-gray-700 rounded-lg overflow-auto flex flex-col items-center justify-center text-center">
                    <div class="flex flex-col items-center">
                        <div class="flex text-center bg-emerald-500 rounded-full w-24 h-24 justify-center items-center">
                            <h1 class="text-7xl text-white font-bold">!</h1>
                        </div>
                        <h1 class="text-3xl text-white font-bold p-2">Seu email não está verificado :(</h1>
                        <span class="text-lg text-gray-300">Para desbloquear as funcionalidades da plataforma, verifique seu email clicando no botão abaixo: </span>
                        <form action="{{ route('auth.cm.validateDash') }}" method="POST">
                            @csrf
                            <button class="mt-4 px-8 py-2 rounded-md bg-emerald-500 text-2xl font-bold text-white">CONFIRMAR EMAIL</button>
                        </form>
                    </div>
                 </div>
                </section>   
            @else
                
            @endif
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WL4RN8XZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

        @if(auth()->user()->hasRole('banido') || auth()->user()->hasPermissionTo('banido'))
            <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-gray-950 bg-opacity-95 z-50"></div>
                <section class="fixed z-50 top-0 left-0 w-full h-full flex justify-center items-center">
                 <div class="lg:w-1/4 w-full h-3/5 bg-gray-700 rounded-lg overflow-auto flex flex-col items-center justify-center text-center">
                    <div class="flex flex-col items-center">
                        <div class="flex text-center bg-red-500 rounded-full w-24 h-24 justify-center items-center">
                            <h1 class="text-7xl text-white font-bold">!</h1>
                        </div>
                        <h1 class="text-3xl text-white font-bold p-2">Você está banido!</h1>
                        <span class="text-lg text-gray-300">Para entender motivos e recursos a serem tomados contate <b>sac@auroraminer.com</b></span>
                    </div>
                 </div>
                </section>   
            @endif


        <x-banner />

        <x-alert-message />
<!-- End Google Tag Manager (noscript) -->
        <div class="min-h-screen bg-gray-950">
            <!-- Page Content -->
            <main class="flex lg:gap-8 lg:justify-between justify-center w-full">
                <x-sidebar />
                {{ $slot }}
                <x-chat />
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            let isSidebarOpen = false;
            let isChatOpen = false;
        
            function toggleSidebar() {
                const sidebar = document.getElementById('mobileSidebar');
                const btnSidebar = document.getElementById('buttonSidebar');
                // Fecha o chat se estiver aberto
                if (isChatOpen) {
                    toggleChat(); // Reaproveita a função toggleChat para fechar o chat
                }
                // Alterna a sidebar
                sidebar.classList.toggle('-translate-x-full');
                btnSidebar.classList.toggle('translate-x-60');
                isSidebarOpen = !isSidebarOpen; // Atualiza o estado da sidebar
            }
        
            function toggleChat() {
                const chat = document.getElementById('chatSidebar');
                const btnChat = document.getElementById('buttonChat');
                // Fecha a sidebar se estiver aberta
                if (isSidebarOpen) {
                    toggleSidebar(); // Reaproveita a função toggleSidebar para fechar a sidebar
                }
                // Alterna o chat
                chat.classList.toggle('translate-x-full');
                btnChat.classList.toggle('-translate-x-60');
                isChatOpen = !isChatOpen; // Atualiza o estado do chat
            }
        </script>
        
        
    </body>
</html>
