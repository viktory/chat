<?php

namespace App\Http\Controllers;

use App\Dialog;
use App\Message;
use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class ChatsController extends Controller
{
    protected $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

//        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index()
    {
        $currentUser = $this->auth->user();
        $users = User::exceptUser($currentUser->id)->exceptAdmins()->orderBy('username', 'asc')->get();

        return view('chat.index', ['currentUser' => $currentUser, 'users' => $users]);
    }

    public function admin()
    {
        $currentUser = $this->auth->user();
//        $users = User::exceptUser($currentUser->id)->exceptAdmins()->get();

//        return view('chat.admin', ['currentUser' => $currentUser, 'users' => $users]);
    }

    public function loadHistory($id)
    {
        $currentUser = $this->auth->user();
        if (($dialog = Dialog::byUsers($id, $currentUser->id)->first()) === null) {
            $messages = [];
        } else {
            $messages = Message::byDialog($dialog->id)->orderBy('created_at', 'asc')->get();
        }
        return view('chat._message', ['messages' => $messages]);
    }
}
