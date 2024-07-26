<?php

namespace Tests\Feature\ApiAuthentication\ApiBusiness;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProductosTest extends TestCase
{
    public function setUp(): void 
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'TestingSeeder']);

        $data = Http::post('http://api.instashare.local/api/login', [
            'email' => 'test@doe.com',
            'password' => 'A123456789a',
        ]);

        $this->_token = 'Bearer '.$data['token'];
    }

    public function test_productos_can_be_created()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
        ])->post('http://api.instashare.local/api/producto', [
            'descripcion'=> 'ASAS',
            'precio'=> 10,
            'um'=> 'mg',
            'categoria_id'=> 1
        ]);

        $this->assertTrue($response['message'] == 'Created Successfully');
    }

    public function test_productos_can_be_modified()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
        ])->put('http://api.instashare.local/api/producto/1', [
            'descripcion'=> 'BBBB',         
        ]);

        $this->assertTrue($response['message'] == 'Retrieved Successfully');
    }

    public function test_productos_can_be_listed()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
        ])->get('http://api.instashare.local/api/producto');

        $this->assertTrue($response['message'] == 'Retrieved Successfully');
    }

    public function test_productos_can_be_showed()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
        ])->get('http://api.instashare.local/api/producto/1');

        $this->assertTrue($response['message'] == 'Retrieved Successfully');
    }

    public function test_productos_can_be_deleted()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->_token
        ])->delete('http://api.instashare.local/api/producto/1');

        $this->assertTrue($response['message'] == 'Deleted Successfully');
    }
}
