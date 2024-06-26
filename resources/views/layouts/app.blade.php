<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
        <link rel="shortcut icon" href="https://aurora-miner.b-cdn.net/images/logo-no-bg.webp" type="image/x-icon">
        <title>Aurora Miner - O melhor site de mineração do Brasil</title>
       @foreach($tags as $tag)
       <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tag->tag_id }}"></script>
       <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ $tag->tag_id }}');
        </script>
        @endforeach
         @foreach($pixels as $pixel)
         <!-- Meta Pixel Code -->
         <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $pixel->pixel_id }}');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id={{ $pixel->pixel_id }}&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
        @endforeach
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

        @if(auth()->user()->hasRole('banido') || auth()->user()->hasPermissionTo('banido'))
            <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-opacity-80 z-50"></div>
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
