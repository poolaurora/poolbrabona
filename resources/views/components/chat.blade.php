<div class="lg:hidden">

    <div id="buttonChat" class="fixed bottom-0 right-0 p-4 z-50 transition-transform duration-300">
        <button id="toggleChat" class="rounded-lg bg-gray-800 text-center p-4 flex justify-center items-center" onclick="toggleChat()">
            <i class="fa-solid fa-message text-gray-500 font-bold"></i>
        </button>
    </div>
    
    <div id="chatSidebar" class="w-64 fixed bg-gray-900 shadow h-screen flex-col justify-between transform translate-x-full right-0 transition-transform duration-300">
        <div class="flex items-center justify-between px-4 py-2 bg-gray-800">
            <div class="text-center p-2 flex justify-center items-center">
                <h2 class="text-base text-white font-semibold">Chat Geral</h2>
            </div>
        </div>
        
        <div class="flex-grow overflow-y-auto h-5/6 flex flex-col-reverse px-4">
            <!-- Chat messages will go here -->
            <div id="messageOutput">
            @foreach ($messages as $message)
                    @if($message->user->hasRole('admin'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <i class="fas fa-crown text-white mr-2"></i>
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-red-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>      
                        <p class="text-sm mt-1 text-white font-bold"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('suporte'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <i class="fa-solid fa-shield-halved text-white mr-2"></i>
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-yellow-500"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-white font-bold"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('shark'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <img src="https://media.discordapp.net/attachments/1219283420207906882/1219284374676050081/shark.png?ex=660abe10&is=65f84910&hm=f590036187593da1583f98a5c8e1047a2c6fdde4d929a96443894e1d04aeb139&=&format=webp&quality=lossless&width=800&height=800" class="size-7 mr-2">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-emerald-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-300"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('lion'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <img src="https://media.discordapp.net/attachments/1219283420207906882/1219284374386900992/lion.png?ex=660abe10&is=65f84910&hm=6fcf46409cd7dbca33941a05e259176971f4a70e54c634d9d9777cd02107163f&=&format=webp&quality=lossless&width=800&height=800" class="size-7 mr-2">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-orange-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-300"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('bear'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <img src="https://media.discordapp.net/attachments/1219283420207906882/1219284374067875850/bear.png?ex=660abe0f&is=65f8490f&hm=ecad8526918ef51b8ac8d3e2ebe25c20419fea40f9e8b56c5844edbbd138ff3d&=&format=webp&quality=lossless&width=800&height=800" class="size-7 mr-2">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-blue-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-400"> {{ $message->message }} </p>
                    </div>
                    @else
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-gray-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-400"> {{ $message->message }} </p>
                    </div>
                    @endif

                    @endforeach
                  </div>
            
            <!-- Repeat for each message -->
        </div>
        
        
        <div class="px-4 py-3 bg-gray-900">
            <div class="relative">
            <form id="chatForm">
                    <input type="text" id="message" class="w-full pl-4 pr-10 py-2 rounded bg-gray-700 text-white placeholder-gray-400 focus:outline-none" placeholder="Escreva sua mensagem...">
                      <button type="submit" class="absolute inset-y-0 right-0 flex items-center justify-center px-4 text-gray-400 hover:text-gray-200">
                          <i class="fas fa-paper-plane"></i>
                      </button>    
                    </form>
            </div>
        </div>
    </div>

</div>

<!-- DESKTOP CHAT -->
<div class="md:hidden lg:flex">
    <div class="w-2/12 fixed right-0 bg-gray-900 shadow h-screen flex-col justify-center hidden sm:flex border-l border-gray-800">
            <div class="flex items-center justify-between px-4 py-2 bg-gray-800">
                  <div class="text-center p-2 flex justify-center items-center">
                      <h2 class="text-base text-white font-semibold">Chat Geral</h2>
                  </div>
              </div>
              
              <div class="flex-grow overflow-y-auto flex flex-col-reverse px-4">
                  <!-- Chat messages will go here -->
                  <div id="messageOutput">
                    @foreach ($messages as $message)
                    @if($message->user->hasRole('admin'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <i class="fas fa-crown text-white mr-2"></i>
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-red-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>      
                        <p class="text-sm mt-1 text-white font-bold"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('suporte'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <i class="fa-solid fa-shield-halved text-white mr-2"></i>
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-yellow-500"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-white font-bold"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('shark'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <img src="https://media.discordapp.net/attachments/1219283420207906882/1219284374676050081/shark.png?ex=660abe10&is=65f84910&hm=f590036187593da1583f98a5c8e1047a2c6fdde4d929a96443894e1d04aeb139&=&format=webp&quality=lossless&width=800&height=800" class="size-7 mr-2">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-emerald-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-300"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('lion'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <img src="https://media.discordapp.net/attachments/1219283420207906882/1219284374386900992/lion.png?ex=660abe10&is=65f84910&hm=6fcf46409cd7dbca33941a05e259176971f4a70e54c634d9d9777cd02107163f&=&format=webp&quality=lossless&width=800&height=800" class="size-7 mr-2">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-orange-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-300"> {{ $message->message }} </p>
                    </div>
                    @elseif($message->user->hasRole('bear'))
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <img src="https://media.discordapp.net/attachments/1219283420207906882/1219284374067875850/bear.png?ex=660abe0f&is=65f8490f&hm=ecad8526918ef51b8ac8d3e2ebe25c20419fea40f9e8b56c5844edbbd138ff3d&=&format=webp&quality=lossless&width=800&height=800" class="size-7 mr-2">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-blue-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-400"> {{ $message->message }} </p>
                    </div>
                    @else
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full" id="message-{{ $message->id }}">
                        <div class="flex items-center">
                        <div class="flex justify-between">
                        <span class="text-lg font-bold text-gray-600"> {{ $message->user->username }} </span></div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suporte'))
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                        </div>
                        <p class="text-sm mt-1 text-gray-400"> {{ $message->message }} </p>
                    </div>
                    @endif

                    @endforeach
                  </div>
                  
                  <!-- Repeat for each message -->
              </div>
              
              
              <div class="px-4 py-3 bg-gray-900">
                  <div class="relative">
                   <form id="chatForm">
                    <input type="text" id="message" class="w-full pl-4 pr-10 py-2 rounded bg-gray-700 text-white placeholder-gray-400 focus:outline-none" placeholder="Escreva sua mensagem...">
                      <button type="submit" class="absolute inset-y-0 right-0 flex items-center justify-center px-4 text-gray-400 hover:text-gray-200">
                          <i class="fas fa-paper-plane"></i>
                      </button>    
                    </form>
                  </div>
              </div>
      </div>      
</div>
<script>
var username = "{{ auth()->user()->username }}";
var role = "{{ auth()->user()->roles->first()->name ?? 'gratis' }}";
</script>