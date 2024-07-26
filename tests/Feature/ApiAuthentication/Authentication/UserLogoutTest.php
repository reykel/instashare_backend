<?php

namespace Tests\Feature\ApiAuthentication\Authentication;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class UserLogoutTest extends TestCase
{
  public function setUp(): void 
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'TestingSeeder']);

        $data = Http::post('http://api.instashare.local/oauth/token', [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'TJASU4CyKk8uHevG0lo79iluM6vdG4Ha7tVYjSqV',
            'username' => 'test@doe.com',
            'password' => 'A123456789a',
            'scope' => 'basic-user'
        ]);
        
        $this->_token = 'Bearer '.$data['access_token'];
    }

    public function test_users_authenticated_can_logout()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
            ])->get('http://api.instashare.local/api/logout');
            
        $this->assertGuest();
            
        $this->assertTrue($response['message'] == 'You are successfully logged out.');
    }

}
