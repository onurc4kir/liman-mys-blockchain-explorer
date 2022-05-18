<?php

use GuzzleHttp\Client;

class LatestNewsController
{
	public function getResponse()
	{

		$client = new GuzzleHttp\Client(
            ['base_uri' => 'https://cryptopanic.com/api/v1/posts/?auth_token=3a0f3ca52e23ae34d1203046b94862efa4e20763']
        );
        $response = $client->request('GET');
        return json_decode($response->getBody()->getContents());
	}

	public function getLatestNews()
	{
		
		$response = $this->getResponse();
 
		$news = (array) $response->{'results'};
		$data = [];
  

     foreach($news as $new){
           
            $data[] = [
                "domain" => $new->{'domain'},
                "title" => $new->{'title'},
                "published_at" => $new->{'published_at'},
                "slug" => $new->{'slug'},
            ];
        }

       
		return view('table', [
            "value" => $data,
            "title" => ["Kaynak","Başlık","Açıklama","Yayınlanma Tarihi"],
            "display" => ["domain","title","slug","published_at"]
        ]);
	}

}