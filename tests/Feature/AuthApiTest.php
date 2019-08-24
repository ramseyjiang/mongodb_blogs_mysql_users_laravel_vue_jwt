<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Figtest\Models\User;

class AuthApiTest extends TestCase
{
    public function testApiRegister()
    {
        $this->deleteUser();

        $data = [
            'email' => 'test@qq.com',
            'name' => 'test',
            'username' => 'test',
            'password' => '12345678',
        ];

        $response = $this->post('api/register', $data);
        
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([ 'access_token', 'token_type', 'expires_in']);

        $this->assertDatabaseHas('users', [
            'email'  => $data['email'],
            'name' => $data['name'],
            'username' => $data['username'],
        ]);
    }

    /**
     * Test email login by api.
     *
     * @return void
     */
    public function testApiLoginByEmail()
    {
        $response = $this->post('api/login', [
            'username'    => 'test@qq.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([ 'access_token', 'token_type', 'expires_in']);
    }

    /**
     * Test for username login by api.
     *
     * @return void
     */
    public function testApiLoginByUsername()
    {
        $response = $this->post('api/login', [
            'username'    => 'test',
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([ 'access_token', 'token_type', 'expires_in']);
    }

    public function testApiEmailLoginFail()
    {
        $response = $this->post('api/login', [
            'username'    => 'test@email.com',
            'password' => 'notlegitpassword'
        ]);

        $response->assertJsonStructure([
            'error',
        ]);
    }

    public function testApiUsernameLoginFail()
    {
        $response = $this->post('api/login', [
            'username'    => 'test',
            'password' => 'notlegitpassword'
        ]);

        $response->assertJsonStructure([
            'error',
        ]);
    }

    public function testLogout()
    {
        $user = User::first();

        $token = \JWTAuth::fromUser($user);
        $this->post('api/logout?token=' . $token)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(['message']);

        $this->assertGuest('api');
    }

    public function testMe()
    {
        $url = 'api/me';

        // Test unauthenticated access.
        $this->post($url, $this->headers())
        ->assertStatus(Response::HTTP_FOUND);

        // Test authenticated access.
        $this->post($url, $this->headers(User::first()))
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([ 'id', 'name', 'username', 'email']);
    }
    public function testRefresh()
    {
        $url = 'api/refresh';

        // Test unauthenticated access.
        $this->post($url, $this->headers())
        ->assertStatus(Response::HTTP_FOUND);

        // Test authenticated access.
        $this->post($url, $this->headers(User::first()))
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([ 'access_token', 'token_type', 'expires_in']);
    }
}
