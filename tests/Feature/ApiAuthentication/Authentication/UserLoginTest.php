<?php

namespace Tests\Feature\ApiAuthentication\Authentication;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class UserLoginTest extends TestCase
{
    public function setUp(): void 
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'TestingSeeder']);
    }

    public function test_users_can_authenticate_using_the_login_endpoint()
    {
        $response = $this->post('http://api.instashare.local/api/login', [
            'email' => 'test@doe.com',
            'password' => 'A123456789a',
        ]);

        $this->assertAuthenticated();

        $this->assertTrue($response['message'] == 'success');
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $response = $this->post('http://api.instashare.local/api/login', [
            'email' => 'test@doe.com',
            'password' => 'A123456789b',
        ]);
            
        $this->assertGuest();
            
        $this->assertTrue($response['message'] == 'These credentials do not match our records.');
    }
}
