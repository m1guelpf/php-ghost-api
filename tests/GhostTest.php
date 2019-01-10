<?php

namespace M1guelpf\GhostAPI\Test;

use GuzzleHttp\Client;

class GhostTest extends \PHPUnit\Framework\TestCase
{
    /** @var \M1guelpf\GhostAPI\Ghost */
    protected $ghost;

    public function setUp()
    {
        parent::setUp();

        $this->ghost = new Ghost();
    }

    /** @test */
    public function it_does_not_have_token()
    {
        $this->assertNull($this->ghost->apiToken);
    }

    /** @test */
    public function you_can_set_api_token()
    {
        $this->ghost->connect('API_TOKEN');
        $this->assertEquals('API_TOKEN', $this->ghost->apiToken);
    }

    /** @test */
    public function you_can_get_client()
    {
        $this->assertInstanceOf(Client::class, $this->ghost->getClient());
    }

    /** @test */
    public function you_can_set_client()
    {
        $newClient = new Client(['base_uri' => 'http://foo.bar']);
        $this->assertInstanceOf(Client::class, $newClient);
        $this->assertNotEquals($this->ghost->getClient(), $newClient);
        $this->ghost->setClient($newClient);
        $this->assertEquals($newClient, $this->ghost->getClient());
    }
}
