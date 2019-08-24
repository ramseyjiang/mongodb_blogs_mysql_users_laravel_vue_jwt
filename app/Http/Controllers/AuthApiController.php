<?php

namespace Figtest\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Figtest\Http\Requests\UserRegisterRequest;
use Figtest\Http\Requests\UserLoginRequest;
use Figtest\Services\UserService;  

class AuthApiController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->userService = $userService;
    }

    public function register(UserRegisterRequest $request)
    {
        $user = $this->userService->createUser($request->all());
        $token = auth('api')->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * It can be returned email or username.
     *
     * @return string
     */
    protected function username()
    {
        return filter_var(request()->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        //Username logs in, it don't need to change anything. Email logs in, it should unset username column, otherwise api cannot login.
        if ($this->username() === 'email') {
            $request->merge([ $this->username() => $request->input('username') ]);
            unset($request['username']);
        }

        if (! $token = auth('api')->attempt($request->all())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
