<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageResponseTest extends TestCase
{
    /**
     * Testing homepage response.
     * @return void
     */
    public function test_homepage_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Testing login page response.
     * @return void
     */
    public function test_login_page_response(): void
    {
        $response = $this->get('/authenticatie-login');

        $response->assertStatus(200);
    }
}
