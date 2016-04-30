<?php

namespace Pog\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiDefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
