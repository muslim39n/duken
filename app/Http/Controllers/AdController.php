<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index($id){
        $ad = Ad::findOrFail($id);

        $ad->views = $ad->views + 1;
        $ad->save();

        $rec_ads = Ad::where('category_id', $ad->category_id)->latest()->limit(10)->get();

        return view('ad.index', compact(['ad', 'rec_ads']));
    }


    public function newAd(){
        $categories = Category::get();

        return view('ad.new', compact('categories'));
    }

    public function create(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');

            $imageFormat = $image->getClientOriginalExtension();

            $imageName = time().'-'.Auth::user()->id;

            if($imageFormat == "png" or $imageFormat == "jpg" or $imageFormat == "jpeg"){
                $request->file('image')->move(public_path('img'), $imageName . '.' . $imageFormat);

                $ad = Ad::create([
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'price' => $request['price'],
                    'category_id' => $request['category_id'],
                    'user_id' => Auth::user()->id,
                    'img' => $imageName,
                    'img_format' => $imageFormat
                ]);
            }
            else {
                $ad = Ad::create([
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'price' => $request['price'],
                    'category_id' => $request['category_id'],
                    'user_id' => Auth::user()->id
                ]);
            }

        }
        else {
            $ad = Ad::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'category_id' => $request['category_id'],
                'user_id' => Auth::user()->id
            ]);
        }

        return redirect()->route('index');
    }

    public function delete(Request $request){
        $ad = Ad::find($request->ad_id);

        if($ad->user->id == Auth::user()->id or Auth::user()->isModerator()){
            $ad->delete();
        }
        else if(Auth::user()->isModerator()){

            Notice::create([
                'moderator_id'=>Auth::user()->id,
                'user_id'=>$ad->user->id,
                'message'=>'Moderator deleted your ad: "'.$ad->name.'"',
                'ad_id'=>$ad->id
            ]);

            $ad->delete();
        }

        return redirect()->route('index');
    }

    public function edit($id){
        $ad = Ad::findOrFail($id);

        if($ad->user->id == Auth::user()->id or Auth::user()->isModerator()){
            $categories = Category::get();
            return view('ad.edit', compact(['ad', 'categories']));
        }

        return redirect()->route('index');
    }

    public function editPost(Request $request){
        $ad = Ad::findOrFail($request->id);

        if($ad->user->id == Auth::user()->id){
            $ad->name = $request->name;
            $ad->description = $request->description;
            $ad->category_id = $request->category_id;
            $ad->price = $request->price;

            $ad->save();
        }
        else if(Auth::user()->isModerator()){
            $ad->name = $request->name;
            $ad->description = $request->description;
            $ad->category_id = $request->category_id;
            $ad->price = $request->price;

            $ad->save();

            Notice::create([
                'moderator_id'=>Auth::user()->id,
                'user_id'=>$ad->user->id,
                'message'=>'Moderator edited your ad: "'.$ad->name.'" '.$request->message,
                'ad_id'=>$ad->id
            ]);
        }

        return redirect()->route('index');
    }

    public function favorite(Request $request){
        $ad = Ad::find($request->ad_id);
        $ad->favoriteUsers()->attach(Auth::user()->id);

        return redirect()->route('user.myfavorites');
    }
    //COMMENT

    public function newComment(Request $request){
        $comment = Comment::create([
            'message' => $request->message,
            'user_id' => Auth::user()->id,
            'ad_id' =>$request->ad_id
        ]);

        return redirect()->route('ad.index', [$request->ad_id]);
    }
}
