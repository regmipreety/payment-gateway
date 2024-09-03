<?php
namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeAPIServices
{
    /**
     * Summary of makeRequest
     * @param mixed $method
     * @param mixed $requestUrl
     * @param mixed $queryParams
     * @param mixed $formParams
     * @param mixed $headers
     * @param boolean $isJsonRequest
     * @return mixed
     */
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $isJsonRequest = false)
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }
        $response = $client->request($method, $requestUrl, [
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'headers' => $headers,
            'query' => $queryParams,
        ]);
        if (method_exists($this, 'decodeResponse')) {
            $response = $response->getBody()->getContents();
        }
        $response = $this->decodeResponse($response);
        return $response;
    }
}
