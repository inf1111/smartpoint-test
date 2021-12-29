<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class DiffTest extends TestCase
{
    /**
     * Perform tests related to diff method
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

        // add “green” => OK
        $response = $this->post('/api/items/green');
        $response->assertStatus(201);

        // remove “yellow “ => OK
        $response = $this->delete('/api/items/yellow');
        $response->assertStatus(404);

        // diff “red, blue, green, yellow” => OK “blue, yellow”
        $response = $this->json(
            'POST',
            '/api/registry/diff',
            [
                'diffArr' => ['red', 'blue', 'green', 'yellow']
            ]
        );
        $response->assertStatus(200);
        $response->assertJson(['blue', 'yellow'], $strict = false);
    }
}
