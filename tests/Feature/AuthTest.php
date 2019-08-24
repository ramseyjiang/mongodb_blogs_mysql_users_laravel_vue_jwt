<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class AuthTest extends TestCase
{
    /**
     * A register test
     *
     * @return void
     */
    public function testRegister()
    {
        $this->deleteUser();

        $data = [
            'email' => 'test@qq.com',
            'name' => 'test',
            'username' => 'test',
            'password' => '12345678',
        ];
        //Send post request
        $response = $this->call('POST', route('register'), $data);
        //Assert it was successful
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);

        $this->assertDatabaseHas('users', [
            'email'  => $data['email'],
            'name' => $data['name'],
            'username' => $data['username'],
        ]);
    }

    /**
     * @test
     * Test email login
     */
    public function testEmailLogin()
    {   
        $response = $this->call('POST', route('login'),[
            'username'    => 'test@qq.com',
            'password' => '12345678',
        ]);
        
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    /**
     * @test
     * Test username login
     */
    public function testUsernameLogin()
    {
        //attempt login
        $response = $this->call('POST', route('login'),[
            'username'    => 'test',
            'password' => '12345678',
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    public function testEmailLoginFail()
    {
        $response = $this->post('login', [
            'username'    => 'test@email.com',
            'password' => 'notlegitpassword'
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([ 'errors' ]);
    }

    public function testUsernameLoginFail()
    {
        $response = $this->post('login', [
            'username'    => 'test',
            'password' => 'notlegitpassword'
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([ 'errors' ]);
    }
}
