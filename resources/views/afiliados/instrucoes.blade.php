<x-app-layout>
    <div class="py-12">
        <div class="lg:w-6/12 w-10/12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 text-white p-8 rounded-lg shadow-lg">
                <h1 class="text-4xl font-bold text-emerald-400 mb-6">Programa de Afiliados</h1>
                @if($user->afiliado)
                <p class="mb-4">
                    Bem-vindo ao nosso Programa de Afiliados da Aurora Miner! Aqui você pode ganhar maquinas e outras vários bonus indicando nossos serviços para outras pessoas. Cada usuário recebe um código de afiliado único que pode ser compartilhado para registrar novos usuários na plataforma.
                </p>
                
                <h2 class="text-2xl font-semibold text-emerald-400 mb-4">Como Funciona?</h2>
                
                <ul class="list-disc list-inside space-y-2">
                    <li>Ao se registrar, você receberá um código de afiliado exclusivo.</li>
                    <li>Compartilhe seu código com amigos, familiares ou nas suas redes sociais.</li>
                    <li>Quando alguém se registrar ou comprar um plano utilizando seu código, você ganhará uma comissão.</li>
                    <li>Acompanhe suas referências e comissões no painel <a class="text-emerald-400" href="#">clicando aqui</a>.</li>
                </ul>
                
                <h2 class="text-2xl font-semibold text-emerald-400 mt-6 mb-4">Recompensas</h2>
                
                <ul class="list-disc list-inside space-y-2">
                    <li>Para cada indicação sua que adquirir um plano Bear ou Lion <b class="text-lg">você irá ganhar uma sala de mineração compatilhada com duração de 30 minutos para 5 pessoas</b></li>
                    <li>Para cada indicação sua que adquirir um plano Shark <b class="text-lg">você irá ganhar uma maquina de mineração no Lv. 02</b></li>
                    <li>Upgrades, salas e maquinas adicionais <b class="text-lg">você irá uma recarga gratuita para uma de suas maquinas.</b></li>
                </ul>
                
                <h2 class="text-2xl font-semibold text-emerald-400 mt-6 mb-4">Comece Agora</h2>
                
                <p>
                    Pronto para começar? Acesse seu painel de controle e copie seu código de afiliado. Compartilhe-o e comece a ganhar comissões hoje mesmo!
                </p>
                
                <div class="mt-8 flex flex-col items-center justify-center">
                <span class="text-xs text-gray-500 p-2">Seu código</span>
                    <span class="inline-block bg-gray-700 text-2xl text-gray-400 font-bold py-2 px-8 rounded">
                    {{ $user->afiliado->codigo_afiliado }}
                    </span>
                    <span class="text-xs text-gray-500 p-2">ou link</span>
                    <span class="inline-block bg-gray-700 text-2xl text-gray-400 font-bold py-2 px-8 rounded">
                       {{ env('APP_URL') }}/?ref={{ $user->afiliado->codigo_afiliado }}
                    </span>
                    <span class="text-xs text-gray-500 p-2">de afiliado informado acima</span>
                </div>
            @else
            <p class="mb-4">
                    Bem-vindo ao nosso Programa de Afiliados da Aurora Miner! Aqui você pode ganhar maquinas e outras vários bonus indicando nossos serviços para outras pessoas. Cada usuário recebe um código de afiliado único que pode ser compartilhado para registrar novos usuários na plataforma.
                </p>
                
                <div class="mt-8">
                    <form action="{{ route('afiliacao.join') }}" method="POST">
                        @csrf
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Tornar-se afiliado
                        </button>
                    </form>
                </div>
            @endif    
            </div>
        </div>
    </div>        
</x-app-layout>
