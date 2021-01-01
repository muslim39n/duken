<div class="ad-card">
    <div class="row">
        <div class="col-md-3 card__image">
            <img src="{{ asset('img/'.$ad->img.'.'.$ad->img_format) }}" width="100%" alt="{{ $ad->name }}">
        </div>
        <div class="col-md-9">
            <a href="{{route('ad.index', [$ad->id])}}"><h3>{{$ad->name}}</h3></a>
            <p>{{$ad->description}}</p>
            <p class="card__category">Category: <a href="#">{{$ad->category->name}}</a></p>
            <p class="card__owner">Owner: <a href="{{ route('user.page', [$ad->user->id]) }}">{{$ad->user->name}}</a></p>
            <p class="card__owner">Price: <span style="color: green">{{ $ad->price }} KZT</span></p>
        </div>
    </div>
    @auth
        @if($ad->user->id == Auth::user()->id)
            <div class="card__owner row">
                <div class="col-md-2" >
                    <a class="card__edit" href="{{route('ad.edit', [$ad->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                </div>
                <form class="col-md-3" style="margin: 0; padding:0"  action="{{route('ad.delete')}}" method="post">
                    @csrf
                    <input name="ad_id" type="text" hidden value="{{ $ad->id }}">
                    <button class="card__delete" type="submit"><i class="fa fa-ban" aria-hidden="true"></i> Delete</button>
                </form>
            </div>
        @else
            <div class="row">
                <form class="col-md-3" style="margin: 0; padding:0"  action="{{route('ad.favorite')}}" method="post">
                    @csrf
                    <input name="ad_id" type="text" hidden value="{{ $ad->id }}">
                    <button class="card__favorite" type="submit"><i class="fa fa-star" aria-hidden="true"></i> Favorite</button>
                </form>
            </div>
        @endif
    @endauth
    <hr>
    <div class="row">
        <div class="col-md-2" >
            <p class="card__views"><i class="fa fa-eye" aria-hidden="true"></i> {{ $ad->views }}</p>
        </div>
    </div>
</div>
