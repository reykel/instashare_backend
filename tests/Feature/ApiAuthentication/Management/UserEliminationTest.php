<?php

namespace Tests\Feature\ApiAuthentication\Management;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEliminationTest extends TestCase
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

    public function test_users_can_be_deleted()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
        ])->post('http://api.instashare.local/api/delete-user', [
            'id' => '2',
        ]);

        $this->assertTrue($response['message'] == 'User have been deleted');
    }
}
