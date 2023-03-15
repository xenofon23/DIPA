<?php

namespace App\Request;

class Request implements RequestInterface
{
    private string $url;
    private string $method;
    private $data;
    private array $headers;

    /**
     * @param string $url
     * @param string $method
     * @param $data
     * @param string $headers
     */
    public function __construct(string $url, string $method, $data, string $headers)
    {
        $this->url = $url;
        $this->method = $method;
        $this->data = $data;
        $this->headers = [];
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
    public function send()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);

        if ($this->data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        }

        if ($this->headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }



}