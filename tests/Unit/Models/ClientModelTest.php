<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use Tests\TestCase;

class ClientModelTest extends TestCase
{
    /** @test */
    public function it_can_return_name_attribute(): void
    {
        $client = new Client();

        $this->assertEmpty($client->name);

        $client->initials = 'A.B.C.D';

        $this->assertEquals($client->initials, $client->name);

        $client->lastname = 'Test';

        $this->assertEquals("{$client->initials} {$client->lastname}", $client->name);

        $client->initials = null;

        $this->assertEquals($client->lastname, $client->name);
    }
}
