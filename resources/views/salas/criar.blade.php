<x-app-layout>
    <div class="py-12" x-data="{ basePrice: 100, durationPrice: 0, capacity: 1, capacityPrice: 5, totalPrice: 100 }">
        <div class="lg:w-7/12 w-11/12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 p-6 shadow-xl sm:rounded-lg">
                <h2 class="text-3xl font-semibold text-gray-300 leading-tight">
                    Criar Nova Sala de Mineração
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Configure sua sala de mineração compartilhada, definindo os parâmetros necessários para que outros usuários possam se juntar e contribuir.
                </p>
                
                <form method="POST" action="{{ route('salas.order') }}" class="mt-8 space-y-6">
                    @csrf
                    <div class="rounded-md shadow-sm space-y-4">
                        <div>
                            <label for="duration" class="block text-lg font-medium text-gray-500">Duração da Sala</label>
                            <select id="duration" name="duration" required @change="durationPrice = $event.target.value" class="appearance-none bg-gray-900 relative block w-full px-3 py-2 border border-gray-600 rounded-md text-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                <option value="" disabled selected>Selecione a duração</option>
                                <option value="15">15 min</option>
                                <option value="30">30 min</option>
                                <option value="50">1 hora</option>
                                <option value="100">2 horas</option>
                            </select>
                        </div>

                        <div>
                            <label for="capacity" class="block text-md font-medium text-gray-700">Capacidade Máxima</label>
                            <input id="capacity" name="capacity" type="number" min="1" x-model="capacity" required class="appearance-none bg-gray-900 relative block w-full px-3 py-2 border border-gray-600 rounded-md placeholder-gray-300 text-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm" placeholder="50">
                        </div>
                    </div>
                    <input type="hidden" name="valorCalculado" :value="(basePrice + parseInt(durationPrice) + (capacity * capacityPrice))">
                    <div class="mt-6 flex justify-between items-center">
                        <div class="p-4">
                            <h1 class="lg:text-xl text-md text-gray-300 font-bold">Valor de criação da sala:</h1>
                            <span class="lg:text-lg text-sm text-gray-400" x-text="'R$' + (basePrice + parseInt(durationPrice) + (capacity * capacityPrice)).toFixed(2)"></span>
                        </div>
                        <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent justify-center uppercase h-16 w-40 text-center text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Criar Sala
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
