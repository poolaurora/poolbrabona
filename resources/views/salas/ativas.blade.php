<x-app-layout>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <h2 class="text-3xl font-bold text-center text-gray-100">Suas salas de mineração</h2>
          <p class="text-gray-300 text-lg text-center my-6">Veja aqui as salas de mineração que você está e informações sobre elas.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              @foreach ($miningRooms as $room)
                              @php
                                $end_date = \Carbon\Carbon::parse($room->end_date)->toIso8601String();
                            @endphp
                  <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                      <div class="p-6 bg-gray-900">
                          <div class="font-bold text-xl mb-3 text-gray-100">{{ $room->name }}</div>
                          <div class="text-gray-300 my-2">Capacidade: 
                              <span class="font-bold text-emerald-400">{{ $room->capacity }} participantes</span>
                          </div>
                          <div class="text-gray-300">Poder Total: 
                              <span class="font-bold text-emerald-400">{{ $room->total_power }}TH/s</span>
                          </div>
                          <div id="countdown{{ $room->id }}" class="mt-4 font-bold text-emerald-400"><span id="timer{{ $room->id }}"></span></div>
                      </div>
                      <div class="bg-gray-800 p-4">
                          <h4 class="text-gray-400 text-sm mb-2">Participantes:</h4>
                          <div class="space-y-2">
                              @foreach($room->contributors as $contributor)
                                  @php
                                      $contribution = $room->userContributions->firstWhere('user_id', $contributor->id);
                                  @endphp
                                  <div class="flex items-center gap-4">
                                      <img class="h-10 w-10 rounded-full object-cover" src="{{ $contributor->profile_photo_url }}" alt="{{ $contributor->username }}">
                                      <div class="text-gray-300">
                                          <div>{{ $contributor->username }}</div>
                                          <div class="text-sm text-gray-400">{{ $contribution->contribution_power ?? 0 }}TH/s</div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
                  <script>
                        // Countdown Timer for each room
                        var countDownDate{{ $room->id }} = new Date("{{ $room->end_date }}").getTime();
      
                        var x{{ $room->id }} = setInterval(function() {
                            var now = new Date().getTime();
                            var distance = countDownDate{{ $room->id }} - now;
      
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
                            document.getElementById("timer{{ $room->id }}").innerHTML = days + "d " + hours + "h "
                            + minutes + "m " + seconds + "s ";
      
                            if (distance < 0) {
                                clearInterval(x{{ $room->id }});
                                document.getElementById("timer{{ $room->id }}").innerHTML = "EXPIRADO";
                            }
                        }, 1000);
                    </script>
              @endforeach
          </div>
      </div>
  </x-app-layout>
  