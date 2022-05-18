<?php

use GuzzleHttp\Client;

class AnalyzeController
{
 private $client;
	public function getResponse($symbol)
	{


$this->$client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.taapi.io/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
  $body = json_encode( (object) array(

    "secret" => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im9udXJyY2tyckBnbWFpbC5jb20iLCJpYXQiOjE2NTI3Njk4ODQsImV4cCI6Nzk1OTk2OTg4NH0.DnITAeXLFuv_2S0_cXzMjp2HJSLqMvKqYbOjL8_Ty0Y',
    "construct" => (object) array(
        "exchange" => "binance",
        "symbol" => "$symbol/USDT",
        "interval" => "1h",
        "indicators" => array(
            (object) array(
                // Relative Strength Index
	        "indicator" => "rsi",
         "id"=>"rsi"
            ),
            (object) array(
                // Chaikin Money Flow
	        "indicator" => "cmf",
           "id"=>"cmf",
	        "period" => 20,
            ),
            (object) array(
	        "indicator" => "adx",
            "id"=>"adx",
            "interval"=>"4h",
            "period" => 42,
            ),
            (object) array(
                // Chaikin Money Flow
	        "indicator" => "ema",
            "id"=>"ema_slow",
	        "period" => 14,
            ),
            (object) array(
                // Chaikin Money Flow
	        "indicator" => "ema",
           "id"=>"ema_fast",
	        "period" => 7,
            ),
        )
    )

));

           
        $response = $this->$client->request(
            'POST',
            'bulk',
            [
                'body' => $body,
                'headers' => ['Content-Type' => 'application/json']
            ]
        );



        return json_decode($response->getBody()->getContents());
	}

	public function getCoinAnalyze()
	{
		
		$response = $this->getResponse(request("symbol"));
		//$countries = (array) $response->{'Countries'};
		$data = [];
    return respond($response,200);
	}

    // public function listGlobal()
	// {
		
	// 	$response = $this->getResponse();

	// 	$data = [];
           
    //     $data[] = [
    //         "NewConfirmed" => $response->{'Global'}->{'NewConfirmed'},
    //         "TotalConfirmed" => $response->{'Global'}->{'TotalConfirmed'},
    //         "NewDeaths" => $response->{'Global'}->{'NewDeaths'},
    //         "TotalDeaths" => $response->{'Global'}->{'TotalDeaths'}
            
    //     ];

	// 	return view('table', [
    //         "value" => $data,
    //         "title" => ["Yeni Vakalar","Vaka Sayısı","Yeni Vefatlar","Vefat Sayısı"],
    //         "display" => ["NewConfirmed","TotalConfirmed","NewDeaths","TotalDeaths"]
    //     ]);
	// }
}