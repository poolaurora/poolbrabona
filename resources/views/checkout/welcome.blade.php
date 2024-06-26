<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Miner - Checkout Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="https://aurora-miner.b-cdn.net/images/logo-no-bg.webp" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Tag Manager -->
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
        @endforeach
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
      @livewireStyles
</head>
<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 mb-6">
        <div class="w-full max-w-4xl mb-6">
            <!-- Banner Principal no Topo -->
            <img src="https://aurora-miner.b-cdn.net/images/CHECKOUT-BANNER.png" alt="Desfrute de um checkout rápido e seguro" class="rounded-lg">
        </div>
        
        <div class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row">
        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-2">
                {{ session('error') }}
            </div>
        @endif

            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-extrabold text-white mb-6">Finalize sua compra com segurança</h2>
                <form action="{{ route('checkout.processPayment') }}" method="POST">
                @csrf
                <input type="hidden" name="txId" value="{{ $checkout->txId }}">
                <div class="space-y-4">
                <div>
                    <label for="nome" class="sr-only">Nome Completo</label>
                    <input id="nome" name="nome" type="text" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="Nome Completo">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="cpf" class="sr-only">CPF</label>
                        <input id="cpf" name="cpf" type="text" inputmode="numeric" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="CPF">
                    </div>
                    <div>
                        <label for="telefone" class="sr-only">Telefone</label>
                        <input id="telefone" name="telefone" type="tel" inputmode="tel" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="Telefone">
                    </div>
                </div>
                <div>
                    <label for="email" class="sr-only">E-mail</label>
                    <input id="email" name="email" type="email" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="E-mail">
                </div>
            </div>
                <div class="mt-6 mb-4">
                    <h3 class="text-xl font-semibold text-white mb-4">Indicação</h3>
                    <div class="bg-gray-700 p-2 cursor-pointer rounded-lg border border-gray-600">
                        <div>
                            <input id="afid" name="afid" type="text" class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded0 focus:none outline-none" placeholder="Código de Indicação" value="{{ $cookieReferralCode ?? '' }}" @if(isset($cookieReferralCode)) readonly @endif>
                        </div>
                    </div>
                </div>

                <div class="mt-6 mb-4">
                    <h3 class="text-xl font-semibold text-white mb-4">Opções de Pagamento</h3>
                    <div class="bg-gray-700 p-4 cursor-pointer rounded-lg border border-blue-500">
                        <label class="inline-flex items-center text-white text-lg">
                            <span class="ml-2"><i class="fa-brands fa-pix text-emerald-500"></i> PIX</span>
                        </label>
                    </div>
                </div>

                
                <button type="submit" class="w-full text-center flex justify-center items-center py-3 px-6 border border-transparent text-sm font-medium rounded text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                  <i class="fas fa-lock mr-2 text-emerald-500"></i> Concluir Compra
              </button>  
                <p class="text-sm text-gray-400 mt-6 flex items-center">
                    <i class="fas fa-shield-alt text-green-500 text-md mr-2"></i><span>Suas informações estão seguras e criptografadas.</span>
                </p>
            </div>

                </form>

                <!-- Formulário de Checkout -->

           <div class="w-full md:w-1/2 bg-gray-700 p-8">
            <h3 class="text-xl font-semibold text-white mb-4">Resumo da Compra</h3>
            @php
                  $description = json_decode($checkout->description, true);
            @endphp

            @if(isset($description['plan']))
                  <ul class="space-y-2">
                        <li class="flex justify-between text-white">
                        <span>Plano</span>
                        <span>{{ $description['plan']['name'] ?? 'N/A' }}</span>
                        </li>
                        <li class="flex justify-between text-white">
                              <span>Quantidade</span>
                              <span>{{ $description['plan']['qtd'] ?? 'N/A' }}</span>
                              </li>
                        <li class="flex justify-between text-white">
                        <span>Valor</span>
                        <span class="font-bold">R${{ number_format($description['plan']['value'] ?? 0, 2, ',', '.') }}</span>
                        </li>
                  </ul>
            @elseif(isset($description['maquinas']))
            <ul class="space-y-2">
                        <li class="flex justify-between text-white">
                        <span>Id do usuário</span>
                        <span>{{ $description['maquinas']['user_id'] ?? 'N/A' }}</span>
                        </li>
                        <li class="flex justify-between text-white">
                              <span>Quantidade</span>
                              <span>{{ $description['maquinas']['qtd'] ?? 'N/A' }}</span>
                              </li>
                        <li class="flex justify-between text-white">
                        <span>Valor</span>
                        <span class="font-bold">R${{ number_format($description['maquinas']['value'] ?? 0, 2, ',', '.') }}</span>
                        </li>
                  </ul>
                @elseif(isset($description['upgradeMaquinas']))
                <ul class="space-y-2">
                            <li class="flex justify-between text-white">
                            <span>Id do usuário</span>
                            <span>{{ $description['upgradeMaquinas']['user_id'] ?? 'N/A' }}</span>
                            </li>
                            <li class="flex justify-between text-white">
                                <span>Level atual da maquina</span>
                                <span>{{ $description['upgradeMaquinas']['level'] ?? 'N/A' }}</span>
                            </li>
                            <li class="flex justify-between text-white">
                                <span>Quantidade</span>
                                <span>{{ $description['upgradeMaquinas']['qtd'] ?? 'N/A' }}</span>
                            </li>
                            <li class="flex justify-between text-white">
                            <span>Valor</span>
                            <span class="font-bold">R${{ number_format($description['upgradeMaquinas']['value'] ?? 0, 2, ',', '.') }}</span>
                            </li>
                    </ul>
                    @elseif(isset($description['salaData']))
                    <ul class="space-y-2">
                                <li class="flex justify-between text-white">
                                <span>Id do usuário</span>
                                <span>{{ $description['salaData']['user_id'] ?? 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between text-white">
                                    <span>Capacidade da sala</span>
                                    <span>{{ $description['salaData']['capacity'] ?? 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between text-white">
                                    <span>Quantidade</span>
                                    <span>{{ $description['salaData']['qtd'] ?? 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between text-white">
                                <span>Valor</span>
                                <span class="font-bold">R${{ number_format($description['salaData']['value'] ?? 0, 2, ',', '.') }}</span>
                                </li>
                        </ul>
                        @elseif(isset($description['UpgradePlanData']))
                        <ul class="space-y-2">
                                    <li class="flex justify-between text-white">
                                    <span>Id do usuário</span>
                                    <span>{{ $description['UpgradePlanData']['user_id'] ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex justify-between text-white">
                                        <span>Quantidade</span>
                                        <span>{{ $description['UpgradePlanData']['qtd'] ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex justify-between text-white">
                                    <span>Valor</span>
                                    <span class="font-bold">R${{ number_format($description['UpgradePlanData']['value'] ?? 0, 2, ',', '.') }}</span>
                                    </li>
                            </ul>
                @else
                    <p>Informações do plano não disponíveis.</p>
                @endif
            </div>

        </div>
        <div class="flex flex-col md:flex-row items-center mt-2 w-full justify-center mt-4 gap-4">
            <img class="w-40 bg-transparent" src="https://aurora-miner.b-cdn.net/images/kiwify.png" alt="">
            <img class="w-80 bg-transparent" src="https://aurora-miner.b-cdn.net/images/compra.png" alt="">
        </div>
        
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>        
@livewireScripts
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var cpfInput = document.getElementById('cpf');
            var telefoneInput = document.getElementById('telefone');

            cpfInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

            telefoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        });
    </script>
</body>
</html>
