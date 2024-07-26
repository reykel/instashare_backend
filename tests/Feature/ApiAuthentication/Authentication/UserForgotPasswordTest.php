<?php

namespace Tests\Feature\ApiAuthentication\Authentication;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class UserForgotPasswordTest extends TestCase
{
  public function setUp(): void 
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'TestingSeeder']);
    }

    public function test_users_can_forget_their_password()
    {
        $response = Http::post('http://api.instashare.local/api/forgot-password', [
                'email' => 'test@doe.com',
            ]);
            
        $this->assertTrue($response['message'] == 'Check your email.');
    }
}
