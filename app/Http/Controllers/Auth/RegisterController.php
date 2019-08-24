<?php

namespace Figtest\Http\Controllers\Auth;

use Figtest\User;
use Figtest\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Figtest\Http\Requests\UserRegisterRequest;
use Illuminate\Auth\Events\Registered;
use Figtest\Services\UserService;  

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * It is used to rewrite a register function in RegistersUsers.
     *
     * @param  Figtest\Http\Requests\UserRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request)
    {
        //Registered is a class can be rewriten after successful registered. Event is similar as a listenr.
        event(new Registered($user = $this->userService->createUser($request->all()))); 

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: response()->json([
                'access_token' => auth('api')->login(auth()->user()),
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
    }
}
