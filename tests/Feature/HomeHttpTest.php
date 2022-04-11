<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeHttpTest extends TestCase
{
    /**
     * Test index page
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');
        $response->assertStatus(200)
                ->assertViewIs('home');
    }
}
