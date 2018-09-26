<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::id())->with('roles')->first();

        return view('user.profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        return dd($request->request);
    }

}
