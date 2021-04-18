<?php

use GuzzleHttp\Client;

class BingMap {
    private $APIurl;
    private $APIkey;
    
    public function __construct()
    {
        $this->APIurl = 'https://dev.virtualearth.net/REST/V1/';
        $this->APIkey = 'AlIYUp-xES16Nn6nkwet_F4HVZkD8egYz3zHHOVaWKn-dFq4tCL9i83Rti-WGwrF';
    }

    public function getDistance($depart, $return) {
        $endpoint = 'Routes';
        $params = [
            'wayPoint.1' => $depart,
            'wayPoint.2' => $return,
        ];
        $response = $this->fetch($endpoint, $params);

        return $response;
    }

    protected function fetch($endpoint = '', $params) {
        $url = $this->APIurl . $endpoint;
        $params['key'] = $this->APIkey;
        $params = $params;

        $client = new Client();

        try {
            $response = $client->get($url, [
               'query' => $params
            ]);
            $resp = $response->getBody()->getContents();
    
            return json_decode($resp,1);
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = json_decode($response->getBody()->getContents(),1);
            echo '<pre>'.print_r($responseBodyAsString['errorDetails'][0], 1).'</pre>';
            exit(1);
        }

    }
}