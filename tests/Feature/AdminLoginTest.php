<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\DatabaseMigrations;
use App\Models\Admin;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class AdminLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function setUp(): void
    // {
//
        // parent::setUp();
//
        // Artisan::call('migrate:fresh --seed');
//
    // }

    public function test_admin_cannot_login(): void
    {

        $this->assertGuest();

        $response = $this->post('/admin/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(302);

        $this->assertGuest();

    }
}
