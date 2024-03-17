<x-app-layout>
      <div class="min-h-screen w-11/12">
          <div class="flex justify-center pt-8 sm:pt-0">
              <div class="mt-8 bg-gray-800 overflow-hidden shadow-xl rounded-lg ">
                  <div class="p-4 md:p-6">
                      <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-4">Extrato</h2>
                      <div class="overflow-x-auto relative">
                          <table class="w-full text-xs sm:text-sm md:text-base text-left text-gray-400">
                              <thead class="text-xs sm:text-sm md:text-base uppercase bg-gray-700 text-gray-400">
                                  <tr>
                                      <th scope="col" class="py-3 px-2 md:px-6">ID</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Data</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Quantia</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Entrada/Saída</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Moeda</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($transactions as $transaction)
                                  <tr class="border-b border-gray-700 hover:bg-gray-700">
                                      <td class="py-4 px-2 md:px-6">{{ $transaction->id }}</td>
                                      <td class="py-4 px-2 md:px-6">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                      @if($transaction->description === 'Saída')
                                      <td class="py-4 px-2 md:px-6 text-red-400"> -{{ $transaction->amount }}</td>
                                      <td class="py-4 px-2 md:px-6 font-bold text-red-400">{{ $transaction->description }}</td>
                                      @else
                                      <td class="py-4 px-2 md:px-6 text-green-400"> +{{ $transaction->amount }}</td>
                                      <td class="py-4 px-2 md:px-6 font-bold text-green-400">{{ $transaction->description }}</td>
                                      @endif
                                      <td class="py-4 px-2 md:px-6">{{ $transaction->type }}</td>
                                  </tr>
                                @endforeach
                                  <!-- Mais linhas conforme necessário -->
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>
  