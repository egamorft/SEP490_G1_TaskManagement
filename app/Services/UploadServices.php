<?php

namespace App\Services;

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\RequestInterface;

class UploadServices
{
    private mixed $client;

    public function __construct()
    {
        //add middleware to attach token to request
        $this->client = Http::withMiddleware(
            Middleware::mapRequest(
                function (RequestInterface $request) {
                    $token = env("TOKEN");
                    $request = $request
                        ->withHeader('Accept', 'application/json')
                        ->withHeader('Content-Type', 'application/json');
                    //attach token to request if it exists
                    if ($token) {
                        $request = $request
                            ->withHeader('Authorization', 'Bearer ' . $token);
                    }
                    return $request;
                },
            )
        );
    }
    
    //private helper function to transform response array to object
    private function _toObject($array)
    {
        $objectStr = json_encode($array);
        $object = json_decode($objectStr);
        return $object;
    }

    public function uploadFileToRemoteHost($file)
    {
        $fileStream = fopen($file, 'r');
        $url = "https://report.sweetsica.com/api/report/upload";
        //send form data
        $response = Http::attach(
            'files',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post($url);

        //throw exception if response is not successful
        $response->throw()->json();
        //get data from response
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj->downloadLink;
    }
}