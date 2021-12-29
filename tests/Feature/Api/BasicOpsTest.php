<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class BasicOpsTest extends TestCase
{
    /**
     * Perform tests of basic operations (add, remove, check)
     *
     * @return void
     */
    public function test()
    {
        // Making these subsequent requests to the API should result in the following responses:

        // add “red” => OK
        $response = $this->post('/api/items/red');
        $response->assertStatus(201);

        // check “red” => OK
        $response = $this->get('/api/items/red');
        $response->assertStatus(200);

        // remove “red” => OK
        $response = $this->delete('/api/items/red');
        $response->assertStatus(204);

        // check “red” => NOT OK
        $response = $this->get('/api/items/red');
        $response->assertStatus(404);
    }
}
