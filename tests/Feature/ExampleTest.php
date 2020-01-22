<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase {

    public function testBasicTest() {
        $response = $this->get('http://uploadtest/');

        $response->assertStatus(200);
    }

}
