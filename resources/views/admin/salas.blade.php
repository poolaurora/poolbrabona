<x-app-layout>
      <div class="py-12">
          <div class="lg:w-11/12 w-11/12 mx-auto px-4 sm:px-6 lg:px-8">
              <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-4 sm:p-6 lg:p-8">
                  <div class="bg-gray-700 rounded-lg p-4">
                      <form action="{{ route('admin.Screate') }}" method="POST">
                          @csrf
                          <div class="mb-4">
                              <label for="duration" class="block text-lg font-medium text-gray-300">Duração da Sala</label>
                              <select id="duration" name="duration" required class="appearance-none bg-gray-900 block w-full px-3 py-2 border border-gray-600 rounded-md text-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                  <option value="" disabled selected>Selecione a duração</option>
                                  <option value="15">15 min</option>
                                  <option value="30">30 min</option>
                                  <option value="50">1 hora</option>
                                  <option value="100">2 horas</option>
                              </select>
                          </div>
  
                          <div class="mb-4">
                              <label for="capacity" class="block text-md font-medium text-gray-300">Capacidade Máxima</label>
                              <input id="capacity" name="capacity" type="number" min="1" required class="appearance-none bg-gray-900 block w-full px-3 py-2 border border-gray-600 rounded-md placeholder-gray-300 text-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="50">
                          </div>
  
                          <div class="mb-4">
                              <label for="role_allowed" class="block text-lg font-medium text-gray-300">Quem tem acesso a sua sala?</label>
                              <select id="role_allowed" name="role_allowed" required class="appearance-none bg-gray-900 block w-full px-3 py-2 border border-gray-600 rounded-md text-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                  <option value="" disabled selected>Selecione os planos</option>
                                  <option value="shark">Shark</option>
                                  <option value="lion">Lion</option>
                                  <option value="bear">Bear</option>
                                  <option value="todos">Todos</option>
                              </select>
                          </div>
  
                          <div class="mb-4">
                              <label for="username" class="block text-lg font-medium text-gray-300">Usuário/Email</label>
                              <input type="text" id="username" name="username" placeholder="Usuário/Email" class="appearance-none bg-gray-900 block w-full px-3 py-2 border border-gray-600 rounded-md text-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                          </div>
  
                          <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                              Criar
                          </button>
                      </form>
                  </div>
  
                  <!-- List Component -->
                  <div class="bg-gray-700 rounded-lg p-4 mt-4">
                      <livewire:room-list />
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>
  