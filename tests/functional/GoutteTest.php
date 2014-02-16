<?php

use Goutte\Client;

class APITest extends TestCase
{
    private $client;
    private $endpoint;

    public function setUp()
    {
        $this->client = new Client();
        $this->endpoint = 'http://localhost:8082';
    }

    public function testStatusesList()
    {
        $this->client->request('GET', sprintf('%s/statuses', $this->endpoint));
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatus());
        $this->assertEquals('text/html', $response->getHeader('Content-Type'));
    }

    public function testLogInPage()
    {
        $this->client->request('GET', sprintf('%s/logIn', $this->endpoint));
        $response = $this->client->getResponse();
        $this->assertEquals(200,$response->getStatus());
    }
}