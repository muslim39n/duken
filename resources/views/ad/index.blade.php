@extends('layouts.app')

@section('title_section'){{ $ad->name }} @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @auth
                    @if($ad->user->id == Auth::user()->id)
                        <div class="row">
                                <form class="col-md-3" style="margin: 0; padding:0"  action="{{route('ad.delete')}}" method="post">
                                    @csrf
                                    <input name="ad_id" type="text" hidden value="{{ $ad->id }}">
                                    <button style="font-size: 18px;" class="card__delete" type="submit"><i class="fa fa-ban" aria-hidden="true"></i> Delete</button>
                                </form>
                            <div class="col-md-3"> <a style="font-size: 18px;"  class="card__edit" href="{{route('ad.edit', [$ad->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            </div>
                        </div>


                       @elseif(Auth::user()->isModerator())
                        <div class="moderator__block">
                            <p class="moderator__p">Moderator block</p>
                            <form style="padding:0" class="col-md-3" style="margin: 0; padding:0"  action="{{route('ad.delete')}}" method="post">
                                @csrf
                                <input name="ad_id" type="text" hidden value="{{ $ad->id }}">
                                <button style="font-size: 18px; margin:0; padding:0" class="card__delete" type="submit"><i class="fa fa-ban" aria-hidden="true"></i> Delete</button>
                            </form>
                             <a style="font-size: 18px;"  class="card__edit" href="{{route('ad.edit', [$ad->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>

                        </div>
                    @endif
                @endauth
                    <img src="{{ asset('img/'.$ad->img.'.'.$ad->img_format) }}" alt="" width="100%">
                <h2>{{ $ad->name }}</h2>
        {{--        <img src="{{ asset('img/1.png') }}" alt="">--}}
                <h5>Description: </h5>
                <p>{{ $ad->description }}</p>
                <h5>Price: </h5>
                <p>{{ $ad->price }}</p>
                <h5>Contacts</h5>
                    <p>Name: <a href="{{ route('user.page', $ad->user->id) }}">{{ $ad->user->name }} </a></p>
                <p>E-mail: {{ $ad->user->email }}</p>
                <h5>Category: </h5>
                <p>{{ $ad->category->name }}</p>

                <div class="" >
                    <p class="card__views"><i class="fa fa-eye" aria-hidden="true"></i> {{ $ad->views }}</p>
                </div>
                    <p class="card__favorite"><i class="fa fa-star" aria-hidden="true"></i> {{ $ad->favoriteUsers()->count() }}</p>

{{--                <div class="">--}}
{{--                    <p class="card__favorite"><i class="fa fa-star" aria-hidden="true"> {{ $ad->favoriteUsers()->count() }}</p>--}}
{{--                </div>--}}
                <hr>
                <div class="comments">
                    <h4 style="color: #333">Comments</h4>
                    @foreach($ad->comments as $comment)
                        <div class="comment">
                            <a href="{{ route('user.page', [$comment->user->id]) }}">{{ $comment->user->name }}</a>
                            <div class="comment__message">
                                {{ $comment->message }}
                            </div>
                            <p class="comment__date">{{ $comment->created_at }}</p>
                        </div>
                    @endforeach
                    @auth
                        <div class="comment__form">
                            <form action="{{ route('ad.new_comment') }}" method="post">
                                @csrf
                                <label for="message">Your comment: </label>
                                <input type="text" hidden name="ad_id" value="{{$ad->id}}">
                                <div class="form-group">
                                    <textarea maxlength="500" class="comment__message" id="message" name="message" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="col-md-3 rec-ads">
                @foreach($rec_ads as $rec_ad)
                    @if($rec_ad->id != $ad->id)
                        @include('ad.reccard')
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
