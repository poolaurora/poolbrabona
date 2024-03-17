<x-app-layout>
      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6">
                  <div class="flex flex-col items-center">
                      <!-- Add Machine Section -->
                      <div class="bg-gray-700 rounded-lg p-4 mt-4 w-full">
                          <h2 class="font-semibold text-xl leading-tight mb-4 text-gray-300">Criar Maquinas</h2>
                          <form action="{{ route('admin.Mcreate') }}" method="POST">
                              @csrf
                              <input type="text" name="username" placeholder="Usuário/Email" class="w-full mb-4 p-2 border rounded bg-gray-800 text-white">
                              <input type="number" name="machine_qtd" placeholder="Quantidade de maquinas" class="w-full mb-4 p-2 border rounded bg-gray-800 text-white">
                              <select name="machine_level" class="w-full mb-4 p-2 border rounded bg-gray-800 text-white">
                                    <option disabled>Selecione o level da maquina</option>
                                    <option value="1">Lv. 01</option>
                                    <option value="2">Lv. 02</option>
                                    <option value="3">Lv. 03</option>
                                    <option value="4">Lv. 04</option>
                                    <!-- Dynamically populate this with machine IDs -->
                                </select>
                              <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Criar
                              </button>
                          </form>
                      </div>

                      <!-- Reload Machine Section -->
                      <div class="bg-gray-700 rounded-lg p-4 mt-4 w-full">
                          <h2 class="font-semibold text-xl leading-tight mb-4 text-gray-300">Recarregar Maquinas</h2>
                          <form action="{{ route('admin.Mcharge') }}" method="POST">
                              @csrf
                              <input type="text" name="username" placeholder="Usuário/Email" class="w-full mb-4 p-2 border rounded bg-gray-800 text-white">
                              <input type="number" name="machine_qtd" placeholder="Quantidade de maquinas" class="w-full mb-4 p-2 border rounded bg-gray-800 text-white">
                              <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                  Recarregar
                              </button>
                          </form>
                      </div>

                      <!-- Destroy Machine Section -->
                      <div class="bg-gray-700 rounded-lg p-4 mt-4 w-full">
                          <h2 class="font-semibold text-xl leading-tight mb-4 text-gray-300">Destroy Machine</h2>
                          <form action="{{ route('admin.Mdelete') }}" method="POST">
                              @csrf
                              <input type="text" name="username" placeholder="Usuário/Email" class="w-full mb-4 p-2 border rounded bg-gray-800 text-white">
                              <input type="number" name="machine_qtd" placeholder="Quantidade de maquinas" class="w-full mb-4 p-2 border rounded bg-gray-800 text-white">
                              <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                  Destruir
                              </button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>