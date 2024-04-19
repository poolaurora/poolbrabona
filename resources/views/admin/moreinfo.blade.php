<x-app-layout>
      
      <div class="flex flex-col justify-center items-center h-screen">
            <div class="card bg-opacity-30 bg-gray-800 rounded-lg rounded-3xl overflow-hidden shadow-2xl max-w-4xl p-5">
                <div class="flex flex-wrap lg:flex-nowrap justify-center lg:justify-start items-center">
                    <img class="w-48 h-48 rounded-full object-cover mx-auto lg:mx-0" src="{{ $user->profile_photo_url }}" alt="Futuristic profile image">
                    
                    <div class="w-full lg:w-2/3 lg:pl-10 mt-5 lg:mt-0">
                        <div class="text-center">
                            <p class="text-2xl text-gray-300 font-bold">{{ $user->name }}</p>
                            <p class="text-xl text-gray-400">{{ $user->username }}</p>
                        </div>
                        
                        <div class="info-card rounded-xl p-4 mt-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    @php
                                    // Extrai e converte o preço do Bitcoin para um float
                                    // Remove 'R$ ', substitui '.' por nada e ',' por '.' para converter corretamente para float
                                    $price = (float)str_replace('.', '', substr($btcDetails['price'], 3));
                                    $price = (float)str_replace(',', '.', $price);
        
                                    $balance = $user->balance->balance;

                                    // A quantidade de Bitcoin do usuário já está em formato numérico adequado
                                    $bitcoinAmount = (float)$balance;
        
                                    // Calcula o valor total em reais
                                    $totalValueInBRL = $price * $bitcoinAmount;
                                    @endphp
                                    <p class="font-bold text-gray-300">Saldo Total</p>
                                    <p class="text-lg text-gray-200">{{ $user->balance->balance }} BTC</p>
                                    <p class="text-sm text-gray-500">R$ {{ number_format($totalValueInBRL, 2, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-300">Total De Maquinas</p>
                                    <p class="text-lg text-gray-200">{{ $totalMachines }}</p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-300 font-bold">Plano:</p>
                                      @if($user->hasRole('admin'))
                                      <div class="bg-red-600/[0.5] p-2 rounded-lg">
                                          <span class="text-red-400">Admin</span>
                                      </div>
                                      @elseif($user->hasRole('suporte'))
                                      <div class="bg-yellow-600/[0.5] p-2 rounded-lg">
                                          <span class="text-yellow-400">Suporte</span>
                                      </div>
                                      @elseif($user->hasRole('shark'))
                                      <div class="bg-emerald-600/[0.5] p-2 rounded-lg">
                                          <span class="text-emerald-400">Shark</span>
                                      </div>
                                      @elseif($user->hasRole('lion'))
                                      <div class="bg-orange-600/[0.5] p-2 rounded-lg">
                                          <span class="text-orange-400">Lion</span>
                                      </div>
                                      @elseif($user->hasRole('bear'))
                                      <div class="bg-blue-600/[0.5] p-2 rounded-lg">
                                          <span class="text-blue-400">Bear</span>
                                      </div>
                                      @elseif($user->hasRole('banido'))
                                      <div class="bg-red-600/[0.5] p-2 rounded-lg">
                                          <span class="text-red-400 font-bold">Banido</span>
                                      </div>
                                      @else
                                      <div class="bg-gray-600/[0.5] p-2 rounded-lg">
                                          <span class="text-gray-400">Grátis</span>
                                      </div>
                                      @endif
                                </div>
                            </div>
                        </div>
    
                        <div class="mt-4">
                           <div class="flex justify-between items-center">
                                <form action="{{ route('admin.banuser', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    <button class="p-4 text-white font-bold rounded-lg bg-red-600">BANIR</button>
                                </form>
                                <form action="{{ route('admin.impersonate', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                <button class="p-4 text-white font-bold rounded-lg bg-orange-600" href="#">IMPERSONATE</button>
                                </form>
                           </div>
                        </div>

                        <div class="info-card rounded-xl p-4 mt-4">
                              <div class="flex justify-between items-center">
                                  <div>
                                      <p class="font-bold text-gray-300">Dia de Compra</p>
                                      <p class="text-lg text-gray-400">
                                        @if($pedido)
                                        {{ $pedido->created_at->format('d/m/Y') }}
                                        @else
                                        Usuário não efetuou uma compra ainda
                                        @endif
                                    </p>
                                  </div>
                                  <div>
                                      <p class="font-bold text-gray-300">Dia para ser bloqueado:</p>
                                      <p class="text-lg text-gray-400">
                                        @if($pedido)
                                        {{ $pedido->created_at->addDays(15)->format('d/m/Y') }}
                                        @else
                                        Usuário não efetuou uma compra ainda
                                        @endif</p>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>