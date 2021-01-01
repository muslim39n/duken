<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userPage($id){
        $user = User::findOrFail($id);

        return view('user.index', compact('user'));
    }

    public function myPage(){
        $user = Auth::user();

        return view('user.index', compact('user'));
    }

    public function myFavorites(){
        $user = Auth::user();

        return view('user.myfavorites', compact('user'));
    }
}
