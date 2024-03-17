<x-app-layout>
<div x-data="{ tab: 'crypto' }" class="w-full min-h-screen flex flex-col items-center justify-center py-12">
    <div class="w-full max-w-md mx-auto mb-4 px-4">
        <h2 class="text-center text-3xl font-extrabold text-white">Efetuar Saque</h2>
        <p class="text-center text-sm text-gray-300">Escolha o método de saque e preencha as informações necessárias.</p>
    </div>

    <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-lg">
        <!-- Tabs -->
        <nav class="flex justify-center flex-col md:flex-row mb-4">
            <a @click.prevent="tab = 'crypto'" :class="{'bg-gray-700 text-white': tab === 'crypto'}" class="text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-700" href="#">Criptomoeda</a>
            <a @click.prevent="tab = 'bank'" :class="{'bg-gray-700 text-white': tab === 'bank'}" class="text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-700 ml-2" href="#">Transferência Bancária</a>
            <a @click.prevent="tab = 'pix'" :class="{'bg-gray-700 text-white': tab === 'pix'}" class="text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-700 ml-2" href="#">Transferência Pix</a>
        </nav>
  
              <!-- Tab Contents -->
              <div x-show="tab === 'crypto'">
                  <!-- Crypto Form -->
                  <form method="POST" class="space-y-6" action="{{ route('saques.store') }}">
                    @csrf
                    <input type="hidden" name="method" value="crypto">
                        <!-- Tipo de Criptomoeda -->
                        <!-- Saldo Disponível -->
                      <div>
                        <div class="text-white">
                            <h3 class="text-lg font-medium">Saldo Disponível:</h3>
                            <p class="text-2xl font-bold">{{ $balance->balance }} BTC</p>
                        </div>
                    </div>
                        <div>
                            <label for="crypto-type" class="block text-sm font-medium text-gray-400">Tipo de Criptomoeda</label>
                            <select disabled id="crypto-type" name="crypto-type" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option>Bitcoin (BTC)</option>
                            </select>
                        </div>
                    
                        <!-- Quantia a Ser Sacada -->
                        <div>
                        <label for="crypto-type" class="block text-sm font-medium text-gray-400">Quantia</label>
                            <input data-id="amount" type="text" id="amount" name="amount" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="0.0">
                            <span class="mt-2 text-xs text-gray-400">Valor em reais: R$0,00</span>  
                        </div>
                    
                        <!-- Endereço da Carteira -->
                        <div>
                            <label for="wallet-address" class="block text-sm font-medium text-gray-400">Endereço da Carteira</label>
                            <input type="text" id="wallet-address" name="wallet-address" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Endereço da carteira">
                        </div>
                    
                        <!-- Botão para Sacar -->
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded">Sacar via Cripto</button>
                    </form>
                    
              </div>
              <div x-show="tab === 'bank'">
                  <!-- Bank Transfer Form - Brazilian Standard -->
                  <form method="POST" class="space-y-6" action="{{ route('saques.store') }}">
                    @csrf
                    <input type="hidden" name="method" value="bank">
                  <!-- Saldo Disponível -->
                      <div>
                        <div class="text-white">
                            <h3 class="text-lg font-medium">Saldo Disponível:</h3>
                            <p class="text-2xl font-bold">{{ $balance->balance }} BTC</p>
                        </div>
                    </div>
                      <!-- Nome do Banco -->
                      <div>
                          <label for="bank-name" class="block text-sm font-medium text-gray-400">Nome do Banco</label>
                          <input type="text" id="bank-name" name="bank-name" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Ex: Banco do Brasil">
                      </div>
              
                      <!-- CPF/CNPJ do Titular da Conta -->
                      <div>
                          <label for="account-holder-cpf-cnpj" class="block text-sm font-medium text-gray-400">CPF/CNPJ do Titular da Conta</label>
                          <input type="text" id="account-holder-cpf-cnpj" name="account-holder-cpf-cnpj" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="000.000.000-00">
                      </div>
              
                      <!-- Agência -->
                      <div>
                          <label for="agency-number" class="block text-sm font-medium text-gray-400">Agência</label>
                          <input type="text" id="agency-number" name="agency-number" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="0000">
                      </div>
              
                      <!-- Número da Conta -->
                      <div>
                          <label for="account-number" class="block text-sm font-medium text-gray-400">Número da Conta</label>
                          <input type="text" id="account-number" name="account-number" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="00000-0">
                      </div>
              
                      <!-- Tipo de Conta -->
                      <div>
                          <label for="account-type" class="block text-sm font-medium text-gray-400">Tipo de Conta</label>
                          <select id="account-type" name="account-type" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                              <option>Corrente</option>
                              <option>Poupança</option>
                          </select>
                      </div>

                      <!-- Quantia a Ser Sacada -->
                      <div>
                        <label for="amount" class="block text-sm font-medium text-gray-400">Quantia</label>
                        <input data-id="amount" type="text" name="amount" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Valor em BTC">
                        <span class="mt-2 text-xs text-gray-400">Valor em reais: R$0,00</span>  
                    </div>
              
                      <!-- Botão para Transferir -->
                      <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded">Transferir</button>
                  </form>
              </div>
              <div x-show="tab === 'pix'">
                  <!-- Pix Form -->
                  <form method="POST" class="space-y-6" action="{{ route('saques.store') }}">
                    @csrf
                    <input type="hidden" name="method" value="pix">
                      <!-- Chave Pix -->
                      <!-- Saldo Disponível -->
                      <div>
                        <div class="text-white">
                            <h3 class="text-lg font-medium">Saldo Disponível:</h3>
                            <p class="text-2xl font-bold">{{ $balance->balance }} BTC</p>
                        </div>
                    </div>

                      <div>
                          <label for="pix-key" class="block text-sm font-medium text-gray-400">Chave Pix</label>
                          <input type="text" id="pix-key" name="pix-key" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Insira sua chave Pix">
                      </div>
                      <!-- Quantia a Ser Sacada -->
                      <div>
                          <label for="amount" class="block text-sm font-medium text-gray-400">Quantia</label>
                          <input data-id="amount" type="text" name="amount" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Valor em BTC">
                          <span class="mt-2 text-xs text-gray-400">Valor em reais: R$0,00</span>  
                      </div>
                      
                      <!-- Descrição (Opcional) -->
                      <div>
                          <label for="description" class="block text-sm font-medium text-gray-400">Descrição (Opcional)</label>
                          <textarea id="description" name="description" rows="3" class="mt-1 bg-gray-800 block w-full pl-3 pr-10 py-2 text-base text-white font-bold border-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Descrição da transação"></textarea>
                      </div>
              
                      <!-- Botão para Sacar via Pix -->
                      <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded">Sacar via Pix</button>
                  </form>
              </div>
              
              
          </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btcInputs = document.querySelectorAll('[data-id="amount"]');
        
            // Remove os caracteres de formatação para converter em número
            let valorDeConversao = "{{ $btcDetails['price'] }}".replace('R$', '').replace('.', '').replace(',', '.').trim();
            const taxaDeConversao = parseFloat(valorDeConversao);
        
            btcInputs.forEach(btcInput => {
                btcInput.addEventListener('input', function () {
                    let valorEmBTC = this.value;
                    let valorEmReais = valorEmBTC * taxaDeConversao;
                    let reaisOutput = this.nextElementSibling;
                    if (reaisOutput) {
                        reaisOutput.textContent = `Valor em reais: R$${valorEmReais.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    }
                });
            });
        });
        </script>
        
            
            

  </x-app-layout>