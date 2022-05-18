<?php

use GuzzleHttp\Client;


class WidgetController
{


    public function getResponse()
	{

		$client = new GuzzleHttp\Client(
            ['base_uri' => 'https://api.coincap.io/v2/assets/bitcoin']
        );
        $response = $client->request('GET');
        return json_decode($response->getBody()->getContents());
	}
   

    public function btc_price_widget()
    {
     $response = $this->getResponse();
     $price = $response->{'data'}->{'priceUsd'};
     $price = number_format((float)$price, 0, '.', '');
        return respond("$price $");
    }
 


    public function try_price_widget(){
		      $client = new GuzzleHttp\Client(
            ['base_uri' => 'https://api.coincap.io/v2/rates/turkish-lira']
        );
        $response = $client->request('GET');
        $response =  json_decode($response->getBody()->getContents());

         $price = $response->{'data'}->{'rateUsd'};
         
         $price = 1/$price;
         $price = number_format((float)$price, 2, '.', '');
        return respond("$price ₺");

    }
}