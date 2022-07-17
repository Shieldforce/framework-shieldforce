<?php

namespace App\Http;

class Request
{

    /**
     * Files of page
     * @var array
     */
    private $files;

    /**
     * URI of page
     * @var string
     */
    private $uri;

    /**
     * Method HTTP of page
     * @var string
     */
    private $httpMethod;

    /**
     * Protocol HTTP of page
     * @var string
     */
    private $protocol;

    /**
     * Params POST of page
     * @var array
     */
    private $postParams = [];

    /**
     * Query Params of page
     * @var array
     */
    private $queryParams = [];

    /**
     * Headers of page
     * @var array
     */
    private $headers = [];

    /**
     * Construct is Class
     */
    public function __construct()
    {
        $this->postParams = $_POST ?? [];
        $this->queryParams = $_GET ?? [];
        $this->headers = getallheaders();
        $this->uri  = $_SERVER['REQUEST_URI'] ?? '/';
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
        if(count($_FILES) > 0) {
            $this->files = $_FILES;
        }
    }

    /**
     * Responsable for request is POST
     * @return array
     */
    public function getPostParamns()
    {
        return $this->postParams;
    }

    /**
     * Responsable for capture method is HTTP
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Responsable for headers request
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Responsable for capture URI
     * @return array
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Responsable for capture Protocol HTTP/HTTPS
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Responsable for files in request
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Responsable for params in request URL
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

}