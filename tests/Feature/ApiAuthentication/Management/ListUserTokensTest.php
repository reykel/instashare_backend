<?php

namespace Tests\Feature\ApiAuthentication\Management;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListUserTokensTest extends TestCase
{
    
    public function setUp(): void 
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'TestingSeeder']);

        $data = Http::post('http://api.instashare.local/api/login', [
            'email' => 'root@doe.com',
            'password' => 'A123456789a',
        ]);

        $this->_token = 'Bearer '.$data['token'];
    }

    public function test_user_tokens_can_be_listed()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
        ])->get('http://api.instashare.local/api/tokens');

        $this->assertTrue($response['message'] == 'All tokens were retrieved');
    }
}
