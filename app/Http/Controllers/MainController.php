<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $ads = Ad::latest()->get();
        $categories = Category::get();

        return view('index', compact(['ads', 'categories']));
    }

    public function search(Request $request){
        $categories = Category::get();
        if($request->category_id == 0){
            $rtext = $request->text;
            $price_from = 0;
            $price_to = Ad::max('price');

            if($request->filled('price_from')){
                $price_from = $request->price_from;
            }

            if($request->filled('price_to')){
                $price_to = $request->price_to;
            }

            $ads = Ad::where('price', '>=', $price_from)
                ->where('price', '<=', $price_to)
                ->where(function($q) use ($rtext){
                    $q->where('name', 'like', '%'.$rtext.'%')
                        ->orWhere('description', 'like', '%'.$rtext.'%');
                })
                ->orderBy('views', 'desc')->get();
            return view('index', compact(['ads', 'categories']));
        }
        else {
            $rtext = $request->text;
            $price_from = 0;
            $price_to = Ad::max('price');

            if($request->filled('price_from')){
                $price_from = $request->price_from;
            }

            if($request->filled('price_to')){
                $price_to = $request->price_to;
            }

            $ads = Ad::where('price', '>=', $price_from)
                ->where('category_id', $request->category_id)
                ->where('price', '<=', $price_to)
                ->where(function($q) use ($rtext){
                    $q->where('name', 'like', '%'.$rtext.'%')
                        ->orWhere('description', 'like', '%'.$rtext.'%');
                })
                ->orderBy('views', 'desc')->get();
            return view('index', compact(['ads', 'categories']));
        }
    }
}
