@extends('layouts.app')

@section('title_section'){{ $user->name }} @endsection

@section('content')
    <div class="container">
        <h3>Name: {{$user->name}}</h3>
        <h4>Email: {{$user->email}}</h4>
        @auth
            @if($user->id == Auth::user()->id)
                <div class="notices">
                    <h4>You have {{$user->notices->count()}} notice(s)</h4>
                    @foreach($user->notices as $notice)
                        <div style="border-left: 2px solid red; padding-left: 20px; margin-left: 30px; margin-top:20px; margin-bottom: 20px">
                            <p style="color: red">{{ $notice->message }}</p>
                            <p>From: <a href="{{route('user.page', $notice->moderator_id)}}">Moderator</a></p>
                        </div>
                    @endforeach
                </div>
            @elseif(Auth::user()->isModerator())
                <div class="moderator__block">
                    <p class="moderator__p">Moderator block</p>
                    <form style="padding:0" class="" style="margin: 0; padding:0"  action="{{route('notice')}}" method="post">
                        @csrf
                        <div class="form-row">
                            <label for="message" class="col-md-12">Leave a message to the user</label>
                            <div class="col-md-8">
                                <input required class="form-control"type="text" name="message" id="message">
                            </div>
                            <input name="user_id" type="text" hidden value="{{ $user->id }}">
                            <div class="col-md-2 offset-1">
                                <label></label>
                                <button style="font-size: 15px; padding: 5px 30px" class="btn btn-danger" type="submit"><i class="fa fa-bell" aria-hidden="true"></i> Notice</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endauth
        <br>
        <h3>User's ads:</h3>
        @foreach($user->ads as $ad)
            @include('ad.card')
        @endforeach

    </div>
@endsection
