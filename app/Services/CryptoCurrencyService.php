<?php

namespace App\Services;

use GuzzleHttp\Client;

class CryptoCurrencyService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl = 'https://min-api.cryptocompare.com/';

    public function __construct()
    {
        $this->client = new Client();
        // Garanta que esta chave é mantida em segredo e não exposta publicamente
        $this->apiKey = '152ab1a3bab67cba67645abc225d49b2743badc40c9b0daea0418f83c6cdd102';
    }

    public function getBtcDetails()
    {
        $response = $this->client->request('GET', "{$this->baseUrl}data/top/mktcapfull", [
            'query' => [
                'fsym' => 'BTC',
                'tsym' => 'BRL',
                'limit' => '1', // Limitando a consulta ao Bitcoin
            ],
            'headers' => [
                'Authorization' => 'Apikey ' . $this->apiKey,
            ],
        ]);
    
        $data = json_decode($response->getBody()->getContents(), true);
    
        if (isset($data['Data'][0])) {
            $btcData = $data['Data'][0]['RAW']['BRL'];
    
            // Calcula a mudança percentual
            $changePct = ($btcData['CHANGE24HOUR'] / ($btcData['PRICE'] - $btcData['CHANGE24HOUR'])) * 100;
    
            return [
                'price' => 'R$ ' . number_format($btcData['PRICE'], 2, ',', '.'),
                'change_24hr' => number_format($changePct, 2, '.', '') . '%',
                'high_24hr' => 'R$ ' . number_format($btcData['HIGH24HOUR'], 2, ',', '.'),
                'low_24hr' => 'R$ ' . number_format($btcData['LOW24HOUR'], 2, ',', '.'),
                'volume_24hr' => number_format($btcData['TOTALVOLUME24H'], 0, '.', '') . ' BTC',
                'market_cap' => 'R$ ' . number_format($btcData['MKTCAP'], 2, ',', '.'),
            ];
        }
    
        return null;
    }
    
}


