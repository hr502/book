<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function setUp(): void
    {

        parent::setUp();

        Artisan::call('migrate:fresh --seed');

    }

    public function test_user_login(): void
    {

        $user = User::factory()->create();

        $this->assertGuest();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect('/');

    }
}
