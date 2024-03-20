<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Miner - PIX</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WL4RN8XZ');</script>
        <!-- End Google Tag Manager -->
<body class="bg-gray-900 text-gray-100">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WL4RN8XZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(pixCode).then(() => {
                alert('Código PIX copiado!');
            }).catch(err => {
                console.error('Erro ao copiar o texto: ', err);
                alert('Erro ao copiar o código PIX.');
            });
        } else {
            // Fallback para browsers que não suportam clipboard.writeText
            // Utilizando execCommand para copiar conteúdo para o clipboard
            const textarea = document.createElement('textarea');
            textarea.value = pixCode;
            document.body.appendChild(textarea);
            textarea.select();

            try {
                const successful = document.execCommand('copy');
                const msg = successful ? 'Código PIX copiado!' : 'Erro ao copiar o código PIX.';
                alert(msg);
            } catch (err) {
                console.error('Erro ao copiar o texto com execCommand: ', err);
                alert('Erro ao copiar o código PIX.');
            }

            document.body.removeChild(textarea);
        }
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
