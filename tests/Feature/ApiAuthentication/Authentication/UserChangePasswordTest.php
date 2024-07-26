<?php

namespace Tests\Feature\ApiAuthentication\Authentication;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class UserChangePasswordTest extends TestCase
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

    public function test_users_can_change_their_password()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
            ])->put('http://api.instashare.local/api/change-password', [
                'old_password' => 'A123456789a',
                'password' => 'A123456789b',
                'password_confirmation' => 'A123456789b',

            ]);
            
        $this->assertGuest();
            
        $this->assertTrue($response['message'] == 'Password updated.');
    }
}
