<?php

use GuzzleHttp\Client;

class ApiController
{
	public function getResponse()
	{

		$client = new GuzzleHttp\Client(
            ['base_uri' => 'https://api.coincap.io/v2/assets?limit=15']
        );
        $response = $client->request('GET');
        return json_decode($response->getBody()->getContents());
	}

	public function listTopCoins()
	{
		
		$response = $this->getResponse();
 
		$coins = (array) $response->{'data'};
		$data = [];
  
  if (is_array($coins) || is_object($coins))
{
     foreach($coins as $coin){
           
            $data[] = [
                "id" => $coin->{'id'},
                "rank" => $coin->{'rank'},
                "symbol" => $coin->{'symbol'},
                "priceUsd" => $coin->{'priceUsd'},
                "changePercent24Hr" => $coin->{'changePercent24Hr'},
            ];
        }
}
       
		return view('table', [
            "value" => $data,
            "title" => ["Id","Rank","Sembol","Fiyat(\$USD)","Yüzdesel Değişim(Günlük)"],
            "display" => ["id","rank","symbol","priceUsd","changePercent24Hr"],
            "onclick" =>"lineOnClickEvent"
        ]);
	}

}