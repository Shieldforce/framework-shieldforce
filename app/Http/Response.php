<?php

namespace App\Http;

class Response
{
    /**
     * Code response
     * @var int
     */
    private $httpCode = 200;

    /**
     * Headers response
     * @var array
     */
    private $headers = [];

    /**
     * Content-Type response
     * @var string
     */
    private $contentType = "text/html";

    /**
     * Content response
     * @var mixed
     */
    private $content;

    /**
     * Method responsable for init is class and receive values
     * @param int $httpCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httpCode, $content, $contentType='text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * Method responsable for update the content type of the response
     * @param $contentType
     * @return void
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Method responsable for add and register in response
     * @param $key
     * @param $value
     * @return void
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Method responsable for send the headers for page
     * @return void
     */
    private function sendHeaders()
    {
        // Status
        http_response_code($this->httpCode);

        // Send Headers
        foreach ($this->headers as $key => $value) {
            header($key.': '.$value);
        }
    }

    /**
     * Method responsable for response the request
     * @return void
     */
    public function sendResponse()
    {
        // Send header set
        $this->sendHeaders();
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }

}