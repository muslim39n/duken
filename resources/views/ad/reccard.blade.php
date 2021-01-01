<div class="rec-ad-card">
        <img src="{{ asset('img/'.$rec_ad->img.'.'.$rec_ad->img_format) }}" width="80%" alt="{{ $rec_ad->name }}">

        <a href="{{route('ad.index', [$rec_ad->id])}}"><p>{{$rec_ad->name}}</p></a>
        <p class="rec-ad__price">{{ $rec_ad->price }} KZT</p>
</div>
