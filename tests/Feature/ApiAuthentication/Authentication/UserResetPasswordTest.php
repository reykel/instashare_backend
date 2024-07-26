<?php

namespace Tests\Feature\ApiAuthentication\Authentication;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class UserResetPasswordTest extends TestCase
{
  public function setUp(): void 
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'TestingSeeder']);
    }

    public function test_users_can_reset_their_password()
    {
        $response = Http::post('http://api.instashare.local/api/reset-password', [
                'email' => 'user@doe.com',
                'token' => 'ePi3CQPilrvQr6IsGLiGPvzvnBHWfeNfvfh8MTYTzvZwVadsa4ZfdidHi9Mf',
                'password' => 'A123456789b',
                'password_confirmation' => 'A123456789b',
            ]);
            
        $this->assertTrue($response['message'] == 'Password updated.');
    }
}
