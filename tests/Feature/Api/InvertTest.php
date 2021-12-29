<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class InvertTest extends TestCase
{
    /**
     * Perform tests related to invert method
     *
     * @return void
     */
    public function test()
    {
        // Making these subsequent requests to the API should result in the following responses:

        // add “red” => OK
        $response = $this->post('/api/items/red');
        $response->assertStatus(201);

        // remove “blue” => OK
        $response = $this->delete('/api/items/blue');
        $response->assertStatus(404);

        // check “red” => OK
        $response = $this->get('/api/items/red');
        $response->assertStatus(200);

        // check “blue” => NOT OK
        $response = $this->get('/api/items/blue');
        $response->assertStatus(404);

        // invert => OK
        $response = $this->post('/api/registry/invert');
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Inversion is now: true'], $strict = false);

        // check “red” => NOT OK
        $response = $this->get('/api/items/red');
        $response->assertStatus(404);

        // check “blue” => OK
        $response = $this->get('/api/items/blue');
        $response->assertStatus(200);
    }
}
