<!DOCTYPE html>
<html lang="pt-BR" class="overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://aurora-miner.b-cdn.net/images/logo-no-bg.webp" type="image/x-icon">
    <title>Aurora Miner - O melhor site de mineração do Brasil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" async referrerpolicy="no-referrer" />
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
        <noscript><img loading="lazy" height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id={{ $pixel->pixel_id }}&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
        @endforeach
    <style>
        * {
            max-width: 100%;
            padding: 0;
            margin: 0;
        }

        .transition-height {
            transition: max-height 0.5s ease-out;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }


        /* Personalização da barra de rolagem para navegadores WebKit (Chrome, Safari, Edge) */
            ::-webkit-scrollbar {
                width: 10px; /* Largura da barra de rolagem */
            }

            ::-webkit-scrollbar-track {
                background: #646464; /* Cor de fundo da trilha da barra de rolagem */
            }

            ::-webkit-scrollbar-thumb {
                background: #888; /* Cor da barra de rolagem */
                border-radius: 5px; /* Arredondamento das bordas da barra de rolagem */
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #555; /* Cor da barra de rolagem ao passar o mouse */
            }

            /* Personalização da barra de rolagem para o Firefox */
            * {
                scrollbar-width: thin; /* "auto" ou "thin" */
                scrollbar-color: #00a581 #303036; /* cor-da-barra cor-de-fundo */
            }

      


        .iframe iframe {
            width: 100%;
            height: 500px;
        }

        @media screen and (max-width: 568px){
            .iframe iframe {
                width: 350px;
                height: 250px;
        }
        }

        .glow {
            animation: glow 2s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% {
            box-shadow: 0 0 5px #10b981, 0 0 15px #10b981, 0 0 30px #10b981, 0 0 60px #10b981;
            }
            50% {
            box-shadow: 0 0 10px #10b981, 0 0 20px #10b981, 0 0 40px #10b981, 0 0 80px #10b981;
            }
        }


        .little-box-glow {
            box-shadow: 0 0 15px #10b981;
        }
        

        .roulette {
            overflow: hidden;
            white-space: nowrap;
        }

        .roulette-inner {
            display: inline-flex;
            animation: none;
        }

        .roulette-item {
            flex: 0 0 auto;
            width: 200px;
            padding: 1rem;
        }
        
        .indicator {
            position: fixed;
            top: -5%;
            left: 50%;
            transform: translate(50%, 50%);
            width: 2px;
            height: 250px;
            background-color: white;
            z-index: 10;
            }

            .indicator::after {
                content: '▲'; /* Símbolo da seta para baixo */
                color: white; /* Cor da seta */
                font-size: 24px; /* Tamanho da seta */
                position: absolute;
                top: 100%;
                left: 50%;
                transform: translateX(-50%);
            }

            .indicator::before {
                content: '▼'; /* Símbolo da seta para baixo */
                color: white; /* Cor da seta */
                font-size: 24px; /* Tamanho da seta */
                position: absolute;
                top: -40px;
                left: 50%;
                transform: translateX(-50%);
            }

    </style>
</head>
<body class="bg-gray-900 text-gray-200 max-w-full">
    <header class="flex flex-row-reverse lg:flex-row items-center justify-between p-4">
        <div class="text-3xl font-bold">
            <a href="#"><img loading="lazy" src="https://aurora-miner.b-cdn.net/images/logo-no-bg.webp" class="size-14 flex lg:justify-left justift-right"></a>
        </div>
        <div class="lg:hidden">
            <button id="menuBtn" class="text-gray-400 hover:text-emerald-500">
                <i class="fas fa-bars fa-2x"></i>
            </button>
        </div>
        <!-- Desktop Navigation -->
        <nav class="hidden w-full lg:flex lg:items-center lg:justify-center lg:w-auto">
            <ul class="flex space-x-4">
            <li><a href="#cloud" class="text-gray-400 hover:text-emerald-500 px-2 py-1">Mineração Cloud</a></li>
                <li><a href="#features" class="text-gray-400 hover:text-emerald-500 px-2 py-1">Vantagens</a></li>
                <li><a href="#plans" class="text-gray-400 hover:text-emerald-500 px-2 py-1">Planos</a></li>
                <li><a href="#faq" class="text-gray-400 hover:text-emerald-500 px-2 py-1">FAQ</a></li>
                <li>
                    <a href="/login" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded">
                        ACESSAR MINHA CONTA
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Mobile Menu -->
        <nav id="menu" class="hidden fixed inset-0 bg-gray-800 bg-opacity-95 z-50">
            <button id="closeBtn" class="absolute top-5 right-5 text-gray-400 hover:text-emerald-500">
                <i class="fas fa-times fa-2x"></i>
            </button>
            <ul class="flex flex-col items-center justify-center h-full space-y-6">
                <li><a href="#cloud" class="text-gray-400 hover:text-emerald-500 px-2 py-1">Mineração Cloud</a></li>
                <li><a href="#features" class="text-gray-400 hover:text-emerald-500 px-2 py-1">Vantagens</a></li>
                <li><a href="#plans" class="text-gray-400 hover:text-emerald-500 px-2 py-1">Planos</a></li>
                <li><a href="#faq" class="text-gray-400 hover:text-emerald-500 px-2 py-1">FAQ</a></li>
                <li>
                    <a href="/login" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded text-lg">
                        ACESSAR MINHA CONTA
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
    <section class="flex justify-center items-center flex-col text-center h-full md:h-screen mb-4 md:mb-1">
        <h1 class="text-2xl sm:text-3xl md:text-6xl lg:text-8xl font-bold mb-4 md:mb-8">
            A melhor plataforma <br> 
            <strong class="text-4xl sm:text-5xl md:text-7xl bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600">
                para minerar bitcoins
            </strong>
        </h1>
        <p class="text-sm sm:text-base md:text-lg lg:w-2/3 bg-clip-text text-transparent bg-gradient-to-b from-gray-300 via-gray-400 to-gray-500 mb-6 md:mb-10">
            Obtenha o melhor ja visto no mercado de mineração de criptomoedas.
        </p>
        <a href="#plans" class="text-white font-bold py-2 sm:py-4 md:py-5 text-base md:text-2xl px-10 md:px-16 rounded bg-emerald-500 hover:bg-emerald-600 transition duration-300 ease-in-out">
            EXPERIMENTAR AGORA
        </a>
    </section>
       
        <section class="md:px-16 md:py-10">
            <div class="flex justify-center">
                <!-- Responsive iframe container -->
                <div class="w-screen md:max-w-4xl mx-auto">
                    <div class="w-full iframe flex justify-center">
                        <iframe class="w-full md:h-auto" src="https://www.youtube.com/embed/m3GGW8k-ooE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                
            </div>            
        </section>
        <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 sm:grid-cols-1 lg:grid-cols-4 gap-6">
               
                <div class="stat relative text-center transition-transform duration-300 ease-in-out">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fa-solid fa-percent text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 fa-2x to-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">ZERO</h2>
                    <p class="text-gray-400">Não cobramos nenhuma taxa de você</p>
                    <div class="absolute inset-0 transition duration-300 ease-in-out"></div>
                </div>
                <div class="stat relative text-center transition-transform duration-300 ease-in-out">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fas fa-users text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 fa-2x to-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">8.000</h2>
                    <p class="text-gray-400">Usuários utilizando a plataforma</p>
                    <div class="absolute inset-0 transition duration-300 ease-in-out"></div>
                </div>
                <div class="stat relative text-center transition-transform duration-300 ease-in-out">
                    <div class="flex items-center justify-center mb-2">
                    <i class="fas fa-clock text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 fa-2x to-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">50 seg</h2>
                    <p class="text-gray-400">Da compra ao login</p>
                    <div class="absolute inset-0 transition duration-300 ease-in-out"></div>
                </div>
                <div class="stat relative text-center transition-transform duration-300 ease-in-out">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fas fa-headset text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 fa-2x to-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">24/7</h2>
                    <p class="text-gray-400">Suporte online, tempo de resposta inferior a 5 minutos</p>
                    <div class="absolute inset-0 transition duration-300 ease-in-out"></div>
                </div>
            </div>
        </div>
    </section>
        

    <section id="cloud" class="text-white py-10">
        <div class="flex flex-col items-center justify-center text-center">
            <!-- Text Section -->
            <div class="lg:w-1/2 px-4 mb-6 lg:mb-0 lg:px-6">
            <h2 class="text-xs uppercase tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-gray-700 to-gray-800">
            MÁQUINAS MAIS POTENTES DO MERCADO
            </h2>                
            <h1 class="text-3xl sm:text-5xl font-bold mt-2 mb-6">
                    A chave para uma <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600">mineração excelente</span>
                </h1>
                <p class="mb-6 text-gray-500">
                    Explore o potencial das ferramentas da Aurora, reconhecidas por sua facilidade de uso, e veja como a tecnologia mais avançada do mercado pode auxiliar em sua mineração.                </p>
            </div>
            <!-- Image/Graphic Section -->
            <div class="lg:w-1/2 px-4 flex justify-center">
                <!-- Replace with actual image -->
                <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/gif.gif" class="rounded-lg shadow-xl w-11/12 md:w-12/12">
            </div>
        </div>
        <!-- Video and Button Section -->
        <div class="flex flex-col items-center my-8">
            <div class="w-full max-w-4xl mx-auto px-4 flex flex-col items-center">
                <a href="#plans" class="mt-6 bg-emerald-500 text-2xl hover:bg-emerald-600 font-bold py-4 px-10 md:py-5 md:px-16 rounded transition duration-300 ease-in-out">
                    EXPERIMENTAR AGORA
                </a>    
            </div>
        </div>    
    </section>

    <section id="features" class="bg-gray-900 text-white py-10">
  <div class="container mx-auto px-4 w-full">
    <div class="text-center flex flex-col items-center">
      <h2 class="text-4xl md:text-6xl font-bold w-9/12">Explore Potenciais Oportunidades <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600">com Nossa Tecnologia.</span></h2>
      <p class="mt-8 text-xl w-8/12 text-transparent bg-clip-text bg-gradient-to-b from-gray-200 via-gray-400 to-gray-600">Desbloqueie o potencial máximo de uma mineração eficiente. Minere sem esforços e alcance suas metas.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8 p-8">
      <!-- Coluna 1 -->
      <div class="flex flex-col items-center text-center">
        <div class="mb-4">
          <!-- Substitua por um componente de ícone real ou imagem -->
          <lord-icon
            src="https://cdn.lordicon.com/yxyampao.json"
            trigger="loop"
            delay="2000"
            colors="primary:#10b981,secondary:#10b981"
            style="width:100px;height:100px">
        </lord-icon>
        </div>
        <h3 class="text-lg font-semibold mb-2">Mineração Eficiente</h3>
        <p class="text-md text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-gray-500 to-gray-600">Maximize sua mineração aproveitando nossa solução avançada de mineração otimizada, desenhada para oferecer um excelente desempenho.</p>
      </div>

      <div class="flex flex-col items-center text-center">
        <div class="mb-4">
          <!-- Substitua por um componente de ícone real ou imagem -->
          <lord-icon
            src="https://cdn.lordicon.com/xmuplryc.json"
            trigger="loop"
            delay="2000"
            colors="primary:#10b981,secondary:#10b981"
            style="width:100px;height:100px">
        </lord-icon>
        </div>
        <h3 class="text-lg font-semibold mb-2">Mineração Global ao Seu Alcance</h3>
        <p class="text-md text-transparent bg-clip-text bg-gradient-to-t from-emerald-400 via-gray-500 to-gray-600">Nossa plataforma de mineração em nuvem liberta você das limitações físicas, permitindo que você minere suas criptos de qualquer lugar, a qualquer momento e em qualquer dispositivo.</p>
      </div>

      <div class="flex flex-col items-center text-center">
        <div class="mb-4">
          <!-- Substitua por um componente de ícone real ou imagem -->
          <lord-icon
            src="https://cdn.lordicon.com/vyqvtrtg.json"
            trigger="loop"
            delay="2000"
            colors="primary:#10b981,secondary:#10b981"
            style="width:100px;height:100px">
        </lord-icon>
        </div>
        <h3 class="text-lg font-semibold mb-2">Mineração Ininterrupta, Lucros Maximizados</h3>
        <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-emerald-400 via-gray-500 to-gray-600">Garanta um fluxo contínuo com nossas máquinas que operam sem parar, assegurando que cada segundo seja aproveitado.</p>
      </div>
    </div>
  </div>
</section>

        

        <section id="plans" class="bg-gray-900 text-white py-10 flex flex-col items-center">
        <div class="lg:w-1/2 px-4 mb-12 lg:mb-0 lg:px-6 text-center">
            <h2 class="text-xs uppercase tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-gray-700 to-gray-800">
            UMA MUDANÇA A 3 CLIQUES DE VOCÊ
            </h2>                
            <h1 class="text-3xl sm:text-5xl font-bold mt-2 mb-6">
                A solução certa <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600">para pessoas ambiciosas</span>
            </h1>
            <p class="mt-4 text-xl text-transparent bg-clip-text bg-gradient-to-b from-gray-200 via-gray-400 to-emerald-500">
                Encontre seu caminho para o sucesso e comece a minerar hoje mesmo com nossos planos personalizados.
            </p>
            </div>


            <div class="container mx-auto px-4 lg:mt-24 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                    <!-- Price Card 1 -->
            <form action="{{ route('checkout.createOrder') }}" method="POST">
            @csrf
            <input type="hidden" name="plan" value="bear">      
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/bear.webp">
                        <h2 class="text-2xl font-bold mb-4">Bear</h2>
                       <p class="text-white text-md rounded-full p-2 w-2/3 text-center mb-6 bg-gradient-to-r from-blue-400 via-blue-600 to-blue-800 font-bold flex items-center justify-center"><i class="fa-solid fa-angles-up mr-4 text-xl"></i> R$1.600,00
                       </p>
                        <p class="text-4xl font-bold mb-6">R$349,90/<b class="text-blue-400">mês</b></p>
                        <ul class="mb-6">
                            <li>✔ 2 MÁQUINAS </li>
                            <li>✔ SUPORTE 24/7</li>
                            <li>✖ MAQUINA LV. 04</li>
                            <li class="mt-4"><a class="text-blue-400" onclick="toggleModal('modalBear')">Mais detalhes</a></li>
                        </ul>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">Escolher Plano</button>
                    </div>
            </form>
            
            <form action="{{ route('checkout.createOrder') }}" method="POST">
                @csrf
                @if(request()->cookie('userDiscount'))     
                <input id="sharkInput" type="hidden" name="plan" value="sharkDiscount">  
                    <!-- Price Card 2 -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md lg:bottom-10 relative">
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600 text-white px-4 py-1 rounded-full shadow-lg">
                            <span class="font-bold lg:text-md text-sm">MELHOR ESCOLHA</span>
                        </div>
                        <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/shark.webp" alt="Shark">
                        <h2 class="text-2xl font-bold mb-4">Shark</h2>
                      <p class="text-white text-md rounded-full p-2 w-2/3 text-center mb-6 glow bg-gradient-to-r from-emerald-400 via-emerald-600 to-emerald-800 font-bold flex items-center justify-center"><i class="fa-solid fa-angles-up mr-4 text-xl"></i> R$4.200,00</p>
                        <p id="SharkPrice" class="text-4xl font-bold mb-6">R$719,92/<b class="text-emerald-400">mês</b></p>
                        <span class="text-emerald-500 text-lg">Parabéns! Você ganhou 20% de desconto!</span>
                        <ul class="mb-6">
                            <li>✔ 4 MÁQUINAS</li>
                            <li>✔ SUPORTE 24/7</li>
                            <li>✔ MAQUINA LV. 04</li>
                            <li class="mt-4"><a class="text-emerald-400" onclick="toggleModal('modalShark')">Mais detalhes</a></li>
                        </ul>
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded w-full">Escolher Plano</button>
                    </div>
                    @else
                    <input id="sharkInput" type="hidden" name="plan" value="shark">  
                    <!-- Price Card 2 -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md lg:bottom-10 relative">
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600 text-white px-4 py-1 rounded-full shadow-lg">
                            <span class="font-bold lg:text-md text-sm">MELHOR ESCOLHA</span>
                        </div>
                        <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/shark.webp" alt="Shark">
                        <h2 class="text-2xl font-bold mb-4">Shark</h2>
                      <p class="text-white text-md rounded-full p-2 w-2/3 text-center mb-6 glow bg-gradient-to-r from-emerald-400 via-emerald-600 to-emerald-800 font-bold flex items-center justify-center"><i class="fa-solid fa-angles-up mr-4 text-xl"></i> R$4.200,00</p> 
                        <p id="SharkPrice" class="text-4xl font-bold mb-6">R$899,90/<b class="text-emerald-400">mês</b></p>
                        <ul class="mb-6">
                            <li>✔ 4 MÁQUINAS</li>
                            <li>✔ SUPORTE 24/7</li>
                            <li>✔ MAQUINA LV. 04</li>
                            <li class="mt-4"><a class="text-emerald-400" onclick="toggleModal('modalShark')">Mais detalhes</a></li>
                        </ul>
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded w-full">Escolher Plano</button>
                    </div>
                    @endif
            </form>        
        
            <form action="{{ route('checkout.createOrder') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="lion">    
                    <!-- Price Card 3 -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/lion.webp">
                        <h2 class="text-2xl font-bold mb-4">Lion</h2>
                  <p class="text-white text-md rounded-full p-2 w-2/3 text-center mb-6 bg-gradient-to-r from-orange-400 via-orange-600 to-orange-800 font-bold flex items-center justify-center"><i class="fa-solid fa-angles-up mr-4 text-xl"></i> R$2.400,00</p>
                        <p class="text-4xl font-bold mb-6">R$569,90/<b class="text-orange-400">mês</b></p>
                        <ul class="mb-6">
                            <li>✔ 3 MÁQUINAS</li>
                            <li>✔ SUPORTE 24/7</li>
                            <li>✖ MAQUINA LV. 04</li>
                            <li class="mt-4"><a class="text-orange-400" onclick="toggleModal('modalLion')">Mais detalhes</a></li>
                        </ul>
                        <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded w-full">Escolher Plano</button>
                    </div>
                </div>
            </div>
        </form> 


        <div id="modalBear" class="z-50 hidden fixed inset-0 bg-black bg-opacity-60 h-full w-full flex items-center justify-center">
            <div class="bg-gray-800 text-white max-h-screen-90 mx-auto my-8 overflow-y-auto p-8 rounded-lg shadow-xl w-full max-w-xl flex flex-col items-center">
            <div class="mt-3 text-center flex flex-col items-center">
            <div class="mt-4 px-7 py-5 w-full text-center flex justify-center">
                <h1 class="text-2xl sm:text-xl font-bold mt-2 mb-6 w-2/3">
                    Vantagens do plano Bear <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600">em mais detalhes</span>
                </h1>                    
            </div>

            <div class="p-4 w-full flex flex-col items-center">
                <div class="flex flex-col items-center text-center w-full">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/vyqvtrtg.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#3b82f6,secondary:#3b82f6"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">ACOMPANHA <span class="p-1 rounded-lg bg-blue-500 text-white">2</span> MÁQUINAS <span class="p-1 rounded-lg bg-blue-500 text-white">LEVEL 02</span></h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-blue-400 via-gray-500 to-gray-600">Garanta um fluxo contínuo de rendimentos com nossas máquinas que operam sem parar, assegurando que cada segundo seja aproveitado para aumentar seus lucros.</p>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/gyblqrqz.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#3b82f6,secondary:#3b82f6"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">ACESSO A CRIAÇÃO DE <span class="p-1 rounded-lg bg-blue-500 text-white">SALAS</span> DE MINERAÇÃO</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-blue-400 via-gray-500 to-gray-600">Salas de mineração permitem que você crie algo similar a uma POOL de mineração em nosso site, com isso é possível maximizar ainda mais o seu lucro.</p>
                    <div class="w-full overflow-hidden rounded-lg shadow-lg mt-2">
                        <iframe class="w-full h-56"
                            src="https://www.youtube.com/embed/OULKQ-if_FM"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/axteoudt.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#3b82f6,secondary:#3b82f6"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">SUPORTE POR <span class="p-1 rounded-lg bg-blue-500 text-white">24/7</span> PARA QUALQUER TIPO DE DÚVIDA</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-blue-400 via-gray-500 to-gray-600">Suporte humano e IA para garantir a melhor usabilidade e experiência possível para cada usuário.</p>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/fdxqrdfe.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#3b82f6,secondary:#3b82f6"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">TAG <span class="p-1 rounded-lg bg-blue-500 text-white">EXCLUSIVA</span> EM NOSSO CHAT</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-blue-400 via-gray-500 to-gray-600">Tenha acesso a uma TAG unica em nosso site para mostrar a todos o seu plano.</p>
                    <div class="w-full overflow-hidden rounded-lg shadow-lg mt-2">
                        <img loading="lazy" class="w-full h-full"
                            src="https://aurora-miner.b-cdn.net/images/bear-tag.webp">
                        </img loading="lazy">
                    </div>
                </div>

            </div>
            <button onclick="toggleModal('modalBear')" id="close-btn" class="mt-5 px-5 py-2 bg-blue-500 text-white text-lg font-medium rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-orange-400 transition duration-300 ease-in-out">
                Fechar
            </button>
        </div>
    </div>
</div><!-- END MODAL BEAR -->


        <div id="modalShark" class="z-50 hidden fixed inset-0 bg-black bg-opacity-60 h-full w-full flex items-center justify-center">
            <div class="bg-gray-800 text-white max-h-screen-90 mx-auto my-8 overflow-y-auto p-8 rounded-lg shadow-xl w-full max-w-xl flex flex-col items-center">
            <div class="mt-3 text-center flex flex-col items-center">
            <div class="mt-4 px-7 py-5 w-full text-center flex justify-center">
                <h1 class="text-2xl sm:text-xl font-bold mt-2 mb-6 w-2/3">
                    Vantagens do plano Shark <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600">em mais detalhes</span>
                </h1>                    
            </div>

            <div class="p-4 w-full flex flex-col items-center">
                <div class="flex flex-col items-center text-center w-full">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/vyqvtrtg.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#10b981,secondary:#10b981"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">ACOMPANHA <span class="p-1 rounded-lg bg-emerald-500 text-white">4</span> MÁQUINAS <span class="p-1 rounded-lg bg-emerald-500 text-white">LEVEL 03</span></h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-emerald-400 via-gray-500 to-gray-600">Garanta um fluxo contínuo de rendimentos com nossas máquinas que operam sem parar, assegurando que cada segundo seja aproveitado para aumentar seus lucros.</p>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/gyblqrqz.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#10b981,secondary:#10b981"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">ACESSO A CRIAÇÃO DE <span class="p-1 rounded-lg bg-emerald-500 text-white">SALAS</span> DE MINERAÇÃO</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-emerald-400 via-gray-500 to-gray-600">Salas de mineração permitem que você crie algo similar a uma POOL de mineração em nosso site, com isso é possível maximizar ainda mais o seu lucro.</p>
                    <div class="w-full overflow-hidden rounded-lg shadow-lg mt-2">
                        <iframe class="w-full h-56"
                            src="https://www.youtube.com/embed/XmhtUWZcxwo"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/axteoudt.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#10b981,secondary:#10b981"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">SUPORTE POR <span class="p-1 rounded-lg bg-emerald-500 text-white">24/7</span> PARA QUALQUER TIPO DE DÚVIDA</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-emerald-400 via-gray-500 to-gray-600">Suporte humano e IA para garantir a melhor usabilidade e experiência possível para cada usuário.</p>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/fdxqrdfe.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#10b981,secondary:#10b981"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">TAG <span class="p-1 rounded-lg bg-emerald-500 text-white">EXCLUSIVA</span> EM NOSSO CHAT</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-emerald-400 via-gray-500 to-gray-600">Tenha acesso a uma TAG unica em nosso site para mostrar a todos o seu plano.</p>
                    <div class="w-full overflow-hidden rounded-lg shadow-lg mt-2">
                        <img loading="lazy" class="w-full h-full"
                            src="https://aurora-miner.b-cdn.net/images/shark-tag.png">
                        </img loading="lazy">
                    </div>
                </div>

            </div>
            <button onclick="toggleModal('modalShark')" id="close-btn" class="mt-5 px-5 py-2 bg-emerald-500 text-white text-lg font-medium rounded-full hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition duration-300 ease-in-out">
                Fechar
            </button>
        </div>
    </div>
</div>



<div id="modalLion" class="z-50 hidden fixed inset-0 bg-black bg-opacity-60 h-full w-full flex items-center justify-center">
            <div class="bg-gray-800 text-white max-h-screen-90 mx-auto my-8 overflow-y-auto p-8 rounded-lg shadow-xl w-full max-w-xl flex flex-col items-center">
            <div class="mt-3 text-center flex flex-col items-center">
            <div class="mt-4 px-7 py-5 w-full text-center flex justify-center">
                <h1 class="text-2xl sm:text-xl font-bold mt-2 mb-6 w-2/3">
                    Vantagens do plano Lion <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600">em mais detalhes</span>
                </h1>                    
            </div>

            <div class="p-4 w-full flex flex-col items-center">
                <div class="flex flex-col items-center text-center w-full">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/vyqvtrtg.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#f97316,secondary:#f97316"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">ACOMPANHA <span class="p-1 rounded-lg bg-orange-500 text-white">3</span> MÁQUINAS <span class="p-1 rounded-lg bg-orange-500 text-white">LEVEL 02</span></h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-orange-400 via-gray-500 to-gray-600">Garanta um fluxo contínuo de rendimentos com nossas máquinas que operam sem parar, assegurando que cada segundo seja aproveitado para aumentar seus lucros.</p>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/gyblqrqz.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#f97316,secondary:#f97316"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">ACESSO A CRIAÇÃO DE <span class="p-1 rounded-lg bg-orange-500 text-white">SALAS</span> DE MINERAÇÃO</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-orange-400 via-gray-500 to-gray-600">Salas de mineração permitem que você crie algo similar a uma POOL de mineração em nosso site, com isso é possível maximizar ainda mais o seu lucro.</p>
                    <div class="w-full overflow-hidden rounded-lg shadow-lg mt-2">
                        <iframe class="w-full h-56"
                            src="https://www.youtube.com/embed/A64tHtgLQJQ"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/axteoudt.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#f97316,secondary:#f97316"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">SUPORTE POR <span class="p-1 rounded-lg bg-orange-500 text-white">24/7</span> PARA QUALQUER TIPO DE DÚVIDA</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-orange-400 via-gray-500 to-gray-600">Suporte humano e IA para garantir a melhor usabilidade e experiência possível para cada usuário.</p>
                </div>

                <div class="flex flex-col items-center text-center w-full mt-4">
                    <div class="mb-4">
                        <!-- Componente de ícone real ou imagem -->
                        <lord-icon
                            src="https://cdn.lordicon.com/fdxqrdfe.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#f97316,secondary:#f97316"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">TAG <span class="p-1 rounded-lg bg-orange-500 text-white">EXCLUSIVA</span> EM NOSSO CHAT</h3>
                    <p class="text-md text-transparent bg-clip-text bg-gradient-to-l from-orange-400 via-gray-500 to-gray-600">Tenha acesso a uma TAG unica em nosso site para mostrar a todos o seu plano.</p>
                    <div class="w-full overflow-hidden rounded-lg shadow-lg mt-2">
                        <img loading="lazy" class="w-full h-full"
                            src="https://aurora-miner.b-cdn.net/images/lion-tag.png">
                        </img loading="lazy">
                    </div>
                </div>

            </div>
            <button onclick="toggleModal('modalLion')" id="close-btn" class="mt-5 px-5 py-2 bg-orange-500 text-white text-lg font-medium rounded-full hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 transition duration-300 ease-in-out">
                Fechar
            </button>
        </div>
    </div>
</div><!-- END MODAL LION -->


        </section>

        <section id="saques" class="bg-gray-900 text-white py-10">
            <div class="justify-center flex text-center flex-col py-4">
                <h1 class="text-white font-bold lg:text-5xl text-4xl">Saques ao vivo</h1>
                <span class="text-gray-500 lg:text-3xl text-2xl">Veja os saques ao vivo de nossos usuários</span>
            </div>

            <div id="saquesContainer" class="saques-container w-full p-4 md:p-8 flex flex-col items-center">
                <div id="userSaques" class="user-saque space-y-3 w-full md:w-3/4 lg:w-1/2">
                  
                </div>
            </div>
        </section>
        


        
        <section id="faq" class="bg-gray-900 text-white py-10">
            <div class="justify-center flex text-center flex-col py-4">
                <h1 class="text-white font-bold lg:text-5xl text-4xl">FAQ</h1>
                <span class="text-gray-500 lg:text-3xl text-2xl">As dúvidas de outras pessoas também pode ser a sua.</span>
            </div>
            <div class="max-w-4xl mx-auto px-4">
                <div class="space-y-4">
                    <!-- Pergunta 1 -->
                    <details class="group" open>
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                            Como faço para me registrar?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                            Para se registrar, clique no botão "Registrar" no canto superior direito da página inicial. Preencha as informações necessárias e siga as instruções para concluir o processo de registro.
                        </p>
                    </details>
                    
                    <!-- Pergunta 2 -->
                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                            Qual é o prazo para retiradas?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                            O prazo para retiradas pode variar dependendo do método escolhido. Geralmente, processamos as retiradas dentro de 24 a 48 horas.
                        </p>
                    </details>
                    
                    <!-- Pergunta 3 -->
                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                            Posso alterar meu plano após a inscrição?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                            Sim, você pode alterar seu plano a qualquer momento. Para fazer isso, acesse as configurações da sua conta e selecione a opção de alteração de plano.
                        </p>
                    </details>

                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                        É simples de usar?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                         Sim, adolescentes e idosos, bem como pessoas das mais variadas idades, utilizam nossa plataforma de mineração.
                        </p>
                    </details>

                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                        Quais são as criptomoedas mineradas?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                        Trabalhamos exclusivamente com Bitcoin.
                        </p>
                    </details>

                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                        Quais são os métodos de saque?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                        Pix, TED e Bitcoin
                        </p>
                    </details>

                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                        Quando posso efetuar saques?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                        Os saques podem ser solicitados a qualquer momento. Após a aprovação, o crédito pode levar no mínimo 4 horas e no máximo 3 dias úteis para ser efetivado.
                        Os limites minimos para saques são calculados automaticamente pela plataforma e variam de usuário para usuário (Normalmente os usuários efetuam o primeiro saque em até 10 dias)
                        </p>
                    </details>

                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                        Como posso ter certeza da segurança do serviço?
                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                        Trabalhamos em parceria com a renomada plataforma de mediação de pagamentos Kiwify, uma das maiores da América Latina, o que garante a segurança das transações.
                        </p>
                    </details>

                    <details class="group">
                        <summary class="text-lg font-semibold cursor-pointer p-4 bg-gray-800">
                        Qual é o período de acesso à plataforma?                        </summary>
                        <p class="text-gray-400 text-base pt-2 leading-relaxed">
                        O acesso à plataforma é concedido mediante a adesão a um plano mensal, com duração de 30 dias a partir da data de pagamento.                        </p>
                    </details>
                    <!-- Adicione mais perguntas conforme necessário -->
                </div>
            </div>
        </section>
           

        @if(!request()->cookie('userDiscount'))     

        <section id="descontos" class="bg-gray-900 text-white py-10">
            <div class="justify-center flex text-center ">
                <h1 class="text-white font-bold lg:text-5xl text-4xl">Teste sua SORTE</h1>
            </div>
            <div class="flex justify-center">
                <div class="flex flex-col justify-center lg:w-2/5">
                    <img loading="lazy" class="hover:scale-105 cursor-pointer" src="https://aurora-miner.b-cdn.net/images/mystery-box.png" alt="">
                    <span class="text-gray-400 text-lg text-center mb-5">Tenha a chance de ganhar até 70% de desconto na compra de um plano! Teste sua <b>SORTE</b> agora!</span>
                    <button id="openBoxButton" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-2 rounded text-2xl">Abrir caixa</button>
                </div>
            </div>
        </section>

        @endif




        <div id="overlay" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-90 z-50"></div>
        
       <!-- RECOMPENSA --> 
        <section id="reward" class="hidden fixed z-50 top-0 left-0 w-full h-full flex justify-center items-center">
            <div class="lg:w-1/4 w-full h-3/5 bg-gray-900 rounded-lg overflow-auto flex flex-col items-center justify-center">
                <div class="text-center flex-col items-center">
                <h1 class="text-white-500 font-bold text-4xl">Você ganhou!</h1>
                <span class="text-gray-300 text-lg">um cupom de descontos para o plano <b class="font-bold text-emerald-500">SHARK</b></span>
            </div>
            <div class="flex w-full justify-center flex-col items-center">
                <img loading="lazy" class="w-2/4" src="https://aurora-miner.b-cdn.net/images/20OFF.png">
                <button id="take-reward" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-2 rounded text-xl w-3/4">RESGATAR RECOMPENSA</button>
            </div>
            </div>
        </section>

        
        <section id="modalSection" class="hidden fixed z-50 top-0 left-0 w-full h-full flex justify-center items-center">
            <section id="SecondModal" class="my-8 lg:w-4/5 w-full h-4/5 bg-gray-900 rounded-lg overflow-auto">
              <div class="flex justify-center p-4">
                <div class="hidden roulette roulette-container w-full max-w-3xl mx-auto" id="roulette-container">
                    <div class="indicator"></div>
                    <div class="roulette-inner" id="roulette">
                        <!-- Repetir para cada item. A quantidade de itens deve ser suficiente para preencher mais de 100% da largura do contêiner para que a animação funcione corretamente -->
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/70OFF.png" class="rounded-lg">
                            <div>
                            <h1 class="text-lg font-bold">70% DE DESCONTO</h1>
                            <span class="text-sm">PLANO SHARK</span>    
                            </div>                        
                        </div>
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/50OFF.png" class="rounded-lg">
                            <div>
                            <h1 class="text-lg font-bold">50% DE DESCONTO</h1>
                            <span class="text-sm">PLANO SHARK</span>    
                            </div>                        
                        </div>
                        <div data-id="desired" class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/20OFF.png" class="rounded-lg">
                        <div>
                        <h1 class="text-lg font-bold">20% DE DESCONTO</h1>
                        <span class="text-sm">PLANO SHARK</span>    
                        </div>                        
                        </div>
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/L70OFF.png" class="rounded-lg">
                            <div>
                        <h1 class="text-lg font-bold">70% DE DESCONTO</h1>
                        <span class="text-sm">PLANO LION</span>

                            </div>
                        </div>
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/L50OFF.png" class="rounded-lg">
                            <div>
                        <h1 class="text-lg font-bold">50% DE DESCONTO</h1>
                        <span class="text-sm">PLANO LION</span>

                            </div>
                        </div>
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/L20OFF.png" class="rounded-lg">
                            <div>
                            <h1 class="text-lg font-bold">20% DE DESCONTO</h1>
                            <span class="text-sm">PLANO LION</span>

                            </div>
                        </div>
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/B70OFF.png" class="rounded-lg">
                            <div>
                            <h1 class="text-lg font-bold">70% DE DESCONTO</h1>
                            <span class="text-sm">PLANO BEAR</span>

                            </div>
                        </div>
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/B50OFF.png" class="rounded-lg">
                            <div>
                            <h1 class="text-lg font-bold">50% DE DESCONTO</h1>
                            <span class="text-sm">PLANO BEAR</span>

                            </div>
                        </div>
                        <div class="border-1 border-gray-900 roulette-item bg-gray-800 rounded-lg shadow-lg">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/B20OFF.png" class="rounded-lg">
                            <div>
                            <h1 class="text-lg font-bold">20% DE DESCONTO</h1>
                            <span class="text-sm">PLANO BEAR</span>

                            </div>
                        </div>
                        <!-- ... outros itens ... -->
                        
                    </div>
                </div>
            </div>  
                



                <div id="innerDiv" class="hidden flex justify-center p-4">
                    <div class="card">
                        <div class="card-inner relative">
                            <div class="card-front p-6 rounded-lg flex flex-col justify-center items-center text-center">
                                <div class="absolute top-14 glow left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white px-4 py-1 rounded-full shadow-lg z-10">
                                    <span class="font-bold lg:text-lg text-sm">EDIÇÃO LIMITADA</span>
                                </div>
                                <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/mystery-box.png" class="rounded-lg mb-2 p-2 w-3/5">
                                <div class="flex justify-center items-center w-full">
                                    <button class="bg-emerald-600 py-2 text-xl font-bold px-4 rounded cursos-pointer">Abrir caixa</button>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>





                <section class="my-8">
                    <div>
                        <h1 class="p-4 text-2xl font-bold">Prêmios:</h1>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-5 gap-3 px-2 w-full">
                        <!-- Repeat for each item -->
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/70OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">70% DE DESCONTO</div>
                            <div class="text-lg">PLANO <b class="font-bold text-emerald-500">SHARK</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/50OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">50% DE DESCONTO</div>

                            <div class="text-lg">PLANO <b class="font-bold text-emerald-500">SHARK</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/20OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">20% DE DESCONTO</div>
                            <div class="text-lg">PLANO <b class="font-bold text-emerald-500">SHARK</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/L70OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">70% DE DESCONTO</div>
                            <div class="text-lg">PLANO <b class="font-bold text-orange-500">LION</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/L50OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">50% DE DESCONTO</div>

                            <div class="text-lg">PLANO <b class="font-bold text-orange-500">LION</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/L20OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">20% DE DESCONTO</div>
                            <div class="text-lg">PLANO <b class="font-bold text-orange-500">LION</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/B70OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">70% DE DESCONTO</div>
                            <div class="text-lg">PLANO <b class="font-bold text-blue-500">BEAR</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/B50OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">50% DE DESCONTO</div>

                            <div class="text-lg">PLANO <b class="font-bold text-blue-500">BEAR</b></div>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-3">
                            <img loading="lazy" src="https://aurora-miner.b-cdn.net/images/B20OFF.png" class="rounded-lg mb-2">
                            <div class="text-lg mb-1 font-bold">20% DE DESCONTO</div>
                            <div class="text-lg">PLANO <b class="font-bold text-blue-500">BEAR</b></div>
                        </div>
                        <!-- ...other items... -->
                    </div>
                </section>
            </section>

        </section>




    </main>

    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="mb-8 md:mb-0">
                    <img loading="lazy" class="w-20" src="https://aurora-miner.b-cdn.net/images/logo-no-bg.webp">
                    <p class="text-gray-400 text-xs">© 2024 Aurora Miner Tecnologia.<br>53.789.138/0001-88<br>AV ALÍCIO ARANTES CAMPOLINA, PIONEIRO 2882 - PR</p>
                </div>
                <div class="mb-8 md:mb-0">
                    <h6 class="font-semibold mb-4">Recursos</h6>
                    <ul>
                        <li><a href="#cloud" class="text-gray-400 hover:text-emerald-500 transition-colors duration-300">Mineração Cloud</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-emerald-500 transition-colors duration-300">Vantagens</a></li>
                        <li><a href="#plans" class="text-gray-400 hover:text-emerald-500 transition-colors duration-300">Planos</a></li>                    </ul>
                </div>
                <div class="mb-8 md:mb-0">
                    <h6 class="font-semibold mb-4">Termos</h6>
                    <ul>
                        <li><a href="/about" class="text-gray-400 hover:text-emerald-500 transition-colors duration-300">Sobre Nós</a></li>
                        <li><a href="/terms" class="text-gray-400 hover:text-emerald-500 transition-colors duration-300">Termos de Uso</a></li>
                        <li><a href="/responsability" class="text-gray-400 hover:text-emerald-500 transition-colors duration-300">Responsabilidades do Usuário</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const menu = document.getElementById('menu');
        const closeBtn = document.getElementById('closeBtn');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        closeBtn.addEventListener('click', () => {
            menu.classList.add('hidden');
        });
    </script>    

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Selecione o link pelo seu ID.
    const cloudLink = document.getElementById('scrollToCloud');

    cloudLink.addEventListener('click', function(e) {
        // Prevenindo o comportamento padrão de navegação direta.
        e.preventDefault();

        // Obtendo o ID do elemento destino a partir do atributo href do link.
        const targetId = this.getAttribute('href').substring(1);
        const target = document.getElementById(targetId);

        // Verificando se o elemento destino existe.
        if (target) {
            // Executando o scroll suave até o elemento destino.
            // A propriedade 'behavior: 'smooth'' é responsável pela animação suave.
            window.scrollTo({
                top: target.offsetTop,  // A posição vertical do elemento no documento.
                behavior: 'smooth'  // O tipo de comportamento do scroll: suave.
            });
        }
    });
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
  window.toggleModal = function(modalId) {
    const modal = document.getElementById(modalId);
    const html = document.documentElement;
    const body = document.body;
    
    modal.classList.toggle('hidden');

    if (modal.classList.contains('hidden')) {
      html.style.overflowY = 'auto';
      body.style.overflowY = 'auto'; // Reativa o scroll vertical quando o modal está fechado.
    } else {
      html.style.overflowY = 'hidden';
      body.style.overflowY = 'hidden'; // Desativa o scroll vertical quando o modal está aberto.
    }
  };
});
</script>

<script src="/js/roulette.js" async></script>
<script src="/js/takereward.js" async></script>
<script src="/js/saques.js"></script>
</body>
</html>
