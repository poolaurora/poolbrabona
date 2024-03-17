<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Miner - PIX</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11154405887"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-11154405887');

    gtag('event', 'begin_checkout', {
        'transaction_id': '{{ $payment->checkout->txId }}',
        'value': {{
            isset(json_decode($payment->checkout->description, true)['plan']) ? json_decode($payment->checkout->description, true)['plan']['value'] :
            (isset(json_decode($payment->checkout->description, true)['maquinas']) ? json_decode($payment->checkout->description, true)['maquinas']['value'] :
            (isset(json_decode($payment->checkout->description, true)['upgradeMaquinas']) ? json_decode($payment->checkout->description, true)['upgradeMaquinas']['value'] :
            (isset(json_decode($payment->checkout->description, true)['salaData']) ? json_decode($payment->checkout->description, true)['salaData']['value'] :
            (isset(json_decode($payment->checkout->description, true)['UpgradePlanData']) ? json_decode($payment->checkout->description, true)['UpgradePlanData']['value'] :
            0)))) 
        }},
        'currency': 'BRL'
    });
</script>
<body class="bg-gray-900 text-gray-100">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-gray-800 rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-6 w-full">
                <div class="uppercase tracking-wide text-sm text-emerald-400 font-semibold">Pedido: {{ $payment->order_id }}</div>
                <p class="block mt-1 text-lg leading-tight font-medium text-white">Valor: R$ 
                    @if(isset(json_decode($payment->checkout->description, true)['plan']))
                    {{ json_decode($payment->checkout->description, true)['plan']['value'] }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['maquinas']))
                    {{ json_decode($payment->checkout->description, true)['maquinas']['value'] }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['upgradeMaquinas']))
                    {{ json_decode($payment->checkout->description, true)['upgradeMaquinas']['value'] }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['salaData']))
                    {{ json_decode($payment->checkout->description, true)['salaData']['value'] }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['UpgradePlanData']))
                    {{ json_decode($payment->checkout->description, true)['UpgradePlanData']['value'] }}
                    @endif
                </p>
                <p class="mt-2 text-gray-300">Copie o código abaixo e cole no seu banco na função PIX Copia e Cola.</p>
                <div class="mt-4 bg-gray-700 p-4 rounded-lg font-mono text-sm break-words">
                <span id="pixCode">{{ $payment->pix_code_url }}</span>
            </div>
            <button id="copyButton" class="mt-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M13.6,7.5h2l-4-4l-4,4h2v6h-2l4,4l4-4h-2V7.5z"/>
                </svg>
                <span>Copiar código (PIX Copia e Cola)</span>
            </button>
                <p class="mt-6 text-gray-300">Você também pode tentar lendo o nosso QRCode:</p>
                <div class="mt-2 flex justify-center">
                    <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                        <img class="max-w-full h-auto" src="data:image/png;base64, {{ $payment->pix_code_base64 }}"  alt="QR Code" />
                    </div>
                </div>
                <div class="mt-4">
                    <ol class="list-decimal list-inside text-gray-300">
                        <li>Abra o aplicativo do seu banco no celular</li>
                        <li>Selecione a opção de pagar com Pix / escanear QR code</li>
                        <li>Após o pagamento, você receberá por email os dados de acesso à sua compra</li>
                    </ol>
                </div>
                <div class="mt-4 bg-emerald-600 p-3 rounded-lg">
                    A compra será confirmada automaticamente após o pagamento.
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('copyButton').addEventListener('click', function() {
        const pixCode = document.getElementById('pixCode').innerText;
        navigator.clipboard.writeText(pixCode).then(() => {
            // Feedback para o usuário de que o texto foi copiado.
        }).catch(err => {
            console.error('Erro ao copiar o texto: ', err);
        });
    });
</script>



<script>
        document.addEventListener('DOMContentLoaded', () => {
         window.Echo.channel('payment')
        .listen('.sucess', (data) => {
            console.log('Event received:', data);
            const currentPageId = window.location.pathname.split('/').pop(); // Captura o ID da URL
            if(data.checkoutId == currentPageId) {
                // O ID do evento corresponde ao ID da página, então você pode redirecionar ou atualizar a página.
                window.location.href = `/checkout/payment/sucess/${data.checkoutId}`;
            }
        });
        });
</script>


</body>
</html>
