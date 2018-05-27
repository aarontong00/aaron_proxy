<?php

require_once 'vendor/autoload.php';

use Proxy\Proxy;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Zend\Diactoros\ServerRequestFactory;

// Create a PSR7 request based on the current browser request.
$request = ServerRequestFactory::fromGlobals();

// Create a guzzle client
$guzzle = new GuzzleHttp\Client();

// Create the proxy instance
$proxy = new Proxy(new GuzzleAdapter($guzzle));

// Add a response filter that removes the encoding headers.
$proxy->filter(new RemoveEncodingFilter());

// Forward the request and get the response.
$response = $proxy->forward($request)->to('https://www.baidu.com');

// Output response to the browser.
(new Zend\Diactoros\Response\SapiEmitter)->emit($response);
 
 ?>