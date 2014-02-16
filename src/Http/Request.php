<?php

namespace Http;

use Negotiation\Negotiator;

class Request
{
    const GET    = 'GET';

    const POST   = 'POST';

    const PUT    = 'PUT';

    const DELETE = 'DELETE';

    private $parameters;

    private $negociator;

    public function getMethod(){
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;

        if (self::POST === $method) {
            return $this->getParameter('_method', $method);
        }

        return $method;
    }

    public function getUri(){
        $uri    = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        if ($pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        return $uri;
    }

    public static  function createFromGlobals(){
        if(isset($_SERVER['CONTENT_TYPE'])){
            if($_SERVER['CONTENT_TYPE']== 'application/json'){
                $param = json_decode($_POST,true);
                return new self($_GET,$param);
            }
        }
        return new self($_GET,$_POST);
    }

    public function __construct(array $query = array(), array $request = array()){
        $this->parameters = array();
        $this->negociator  = new \Negotiation\FormatNegotiator();
        $this->parameters = array_merge ($query,$request);
    }

    public function getParameter($name, $default = null)
    {
        return $this->parameters["$name"];
    }

    public function guessBestFormat(){

        $acceptHeader = $_SERVER['HTTP_ACCEPT'];
        return $this->negociator->getBestFormat($acceptHeader);
    }
}