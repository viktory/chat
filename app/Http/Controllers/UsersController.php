<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

//        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @param Requests\RegistrationFormRequest $request
     */
    public function registration(Requests\RegistrationFormRequest $request)
    {
        $data = $request->only('username', 'email', 'password');
        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();
    }

    /**
     *  User should be authorised on cases:
     *      1. username is correct and email is empty
     *      2. email is correct and username is empty
     *      3. username is correct and email is correct
     *
     * @param Requests\LoginFormRequest $request
     *
     * @return $this
     */
    public function login(Requests\LoginFormRequest $request)
    {
        $data = $request->only('username', 'email', 'password');
        if (empty($data['username'])) {
            unset($data['username']);
        } elseif (empty($data['email'])) {
            unset($data['email']);
        }
        if ($this->auth->attempt($data)) {

        }

        return redirect('/')->withErrors([
            'username' => 'Incorrect username, email or password',
        ], $request->getErrorBag());
    }
}
