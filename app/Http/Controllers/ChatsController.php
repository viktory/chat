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

        $this->middleware('auth');
        $this->middleware('admin', ['only' => 'admin']);
        $this->middleware('notAdmin', ['only' => 'index']);
    }

    public function index()
    {
        $currentUser = $this->auth->user();
        $users = User::exceptUser($currentUser->id)->exceptAdmins()->orderBy('username', 'asc')->get();

        return view('chat.index', ['currentUser' => $currentUser, 'users' => $users, 'createActionName' => Message::CREATE_ACTION_NAME]);
    }

    public function admin()
    {
        $currentUser = $this->auth->user();
        $dialogs = Dialog::all();

        return view('chat.admin', ['currentUser' => $currentUser, 'dialogs' => $dialogs, 'deleteActionName' => Message::DELETE_ACTION_NAME]);
    }

    public function loadHistory(Request $request, $from, $to = null)
    {
        $currentUser = $this->auth->user();
        if ($currentUser->is_admin) {
            if ($to === null) {
                abort(404);
            }
        } else {
            $to = $currentUser->id;
        }

        if (($dialog = Dialog::byUsers($from, $to)->first()) === null) {
            $messages = [];
        } else {
            $messages = Message::byDialog($dialog->id)->orderBy('created_at', 'asc')->get();
        }
        $data = ['messages' => $messages, 'isAdmin' => $currentUser->is_admin];
        if ($request->ajax()) {
           $viewName = 'chat._message';
        } else {
            $viewName = 'chat.history';
            $data['currentUser'] = $currentUser;
        }
        return view($viewName, $data);
    }
}
