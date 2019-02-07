<?php
namespace Tests;

use Tests\TestCase;
use App\Developers;

class DevelopersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDevelopers()
    {
		$response = $this->json('GET', '/api/notProtectedDevelopers');
		$expectedResponse=Developers::all()->toArray();
        $response->assertStatus(200)->assertJson($expectedResponse);

    }
}
