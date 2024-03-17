<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Miner - Checkout Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11154405887"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-11154405887');
    </script>    
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
            <img src="/images/checkout-banner.png" alt="Desfrute de um checkout rápido e seguro" class="rounded-lg">
        </div>
        
        <div class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-extrabold text-white mb-6">Finalize sua compra com segurança</h2>
                <form action="{{ route('checkout.processPayment') }}" method="POST">
                @csrf
                @livewire('checkout-form', ['txId' => $checkout->txId, 'oldCheckout' => $oldCheckout])
                <input type="hidden" name="txId" value="{{ $checkout->txId }}">
                <div class="mt-6 mb-4">
                    <h3 class="text-xl font-semibold text-white mb-4">Opções de Pagamento</h3>
                    <div class="bg-gray-700 p-4 cursor-pointer rounded-lg border border-blue-500">
                        <label class="inline-flex items-center text-white text-lg">
                            <span class="ml-2"><i class="fa-brands fa-pix text-emerald-500"></i> PIX</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full flex justify-center py-2 mt-4 px-4 border border-transparent text-sm font-medium rounded text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
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

        
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>        
@livewireScripts
<script>
      $(document).ready(function(){
          $('#cpf').mask('000.000.000-00', {reverse: true});
          $('#telefone').mask('(00) 00000-0000');
      });
  </script>
</body>
</html>
