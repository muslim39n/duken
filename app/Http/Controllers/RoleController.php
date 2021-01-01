<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    //ADMIN
    public function newCategory(){
        if(Auth::user()->isAdmin()){
            return view('admin.newcategory');
        }

        return redirect()->route('index');
    }
    public function newCategoryPost(Request $request){
        if(Auth::user()->isAdmin()){
            Category::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
        }

        return redirect()->route('index');
    }

    public function giveRole(){
        if(Auth::user()->isAdmin()){
            $users = User::get();
            return view('admin.giverole', compact('users'));
        }

        return redirect()->route('index');
    }

    public function giveRoleGet($user_id, $role_id){
        if(Auth::user()->isAdmin()){
            $user = User::find($user_id);

            $user->roles()->attach($role_id);
        }

        return redirect()->route('admin.give_role');
    }

    public function notice(Request $request){
        if(Auth::user()->isModerator()){
            Notice::create([
                'moderator_id'=>Auth::user()->id,
                'user_id'=>$request->user_id,
                'message'=>$request->message
            ]);
        }
        return redirect()->route('user.page', $request->user_id);
    }
}
