<?php

namespace Tests\Feature\ApiAuthentication\Authentication;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegisterTest extends TestCase
{
    
    public function setUp(): void 
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'TestingSeeder']);
    }

    public function test_users_can_register()
    {
        $response = $this->post('http://api.instashare.local/api/register', [
            'email' => 'test2@doe.com',
            'password' => 'A123456789a',
            'password_confirmation' => 'A123456789a',
            'name' => 'Test2',
        ]);

        $this->assertTrue($response['message'] == 'success');

    }
    
}
