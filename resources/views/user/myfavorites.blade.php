@extends('layouts.app')

@section('title_section')Favorites @endsection

@section('content')
    <div class="container">
        <h2>{{$user->name}}</h2>
        <br>
        <h3>Your favorite ads:</h3>
        @foreach($user->favoriteAds as $ad)
            @include('ad.card')
        @endforeach

    </div>
@endsection
