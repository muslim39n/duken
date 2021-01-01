<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class LanguageController extends Controller
{
    public function kz(){
        session(['lang' => 'kz']);
        App::setLocale('kz');

        return redirect()->route('login');
    }
    public function en(){
        session(['lang' => 'en']);
        App::setLocale('en');

        return redirect()->route('login');
    }
    public function ru(){
        session(['lang' => 'ru']);
        App::setLocale('ru');

        return redirect()->route('login');
    }
}
