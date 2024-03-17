<x-app-layout>
    <div class="lg:w-7/12 md:w-9/12 w-full mx-auto p-8 rounded-lg shadow">
        <h2 class="text-3xl font-bold text-center text-emerald-400 mb-6">Salas De Mineração Online</h2>
        <p class="text-gray-400 text-md text-center mb-8">Confira as salas de mineração compartilhada disponíveis agora.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($miningRooms as $room)
            @php
            $isContributor = $room->contributors->contains('id', auth()->user()->id);
            @endphp
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transition duration-300 ease-in-out hover:scale-105">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Sala de {{ $room->user->username ?? 'Usuário Desconhecido' }}</h3>
                    <p class="text-gray-400 mb-6">Capacidade: {{ $room->total_power }} TH/s</p>
                    <form action="{{ route('salas.join', ['id' => $room->id]) }}" method="POST">
                        @csrf
                        @if(auth()->user()->roles->isEmpty())
                        <button type="submit" disabled class="w-full text-white bg-gray-600 focus:ring-4 focus:ring-emerald-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 {{ $isContributor ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $isContributor ? 'disabled' : '' }}>
                            Você precisa de um plano
                        </button>
                        @else
                        <button type="submit" class="w-full text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 {{ $isContributor ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $isContributor ? 'disabled' : '' }}>
                            {{ $isContributor ? 'Já está na Sala' : 'Entrar na Sala' }}
                        </button>
                        @endif
                    </form>
                </div>
                <div class="bg-gray-700 p-4">
                    <span class="text-gray-400 font-medium">Participantes:</span>
                    <div class="flex flex-wrap items-center justify-start gap-4 mt-2">
                        @foreach($room->contributors as $contributor)
                        <div class="flex items-center gap-2">
                            <img class="h-8 w-8 rounded-full" src="{{ $contributor->profile_photo_url }}" alt="Avatar do usuário">
                            <span class="text-gray-300 text-sm">{{ $contributor->username }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
