<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DetailRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        // $userItems = new User();
        return view('users.index')->with('users', $users);
    }

    public function follow()
    {
        $users = User::all();
        // $userItems = new User();
        return view('users.follow')->with('users', $users);
    }

    /**
     * 詳細表示
     */
    public function detail(DetailRequest $request)
    {
        $id = $request->id;
        $userId = User::find($id);
        return view('users.detail', ['userId' => $userId]);
    }

}
