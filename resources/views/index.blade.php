@extends('layouts.app')

@section('title_section')Main page  @endsection

@section('content')
    <div class="container">
        @auth
            @if(Auth::user()->isAdmin())
                <div class="admin__block">
                    <p class="admin__p">Admin block</p>
                    <p><a href="{{ route('admin.new_category') }}">New category</a></p>
                    <p><a href="{{ route('admin.give_role') }}">Create admin/moderator</a></p>
                </div>
            @endif
            @if(Auth::user()->isModerator())
                <div class="moderator__block">
                    <p class="moderator__p">Moderator block</p>
                    some text
                </div>
            @endif
        @endauth

        <div class="search" style="margin-top: 50px;">
            <h2 style="margin-bottom: 35px">Search</h2>
            <form action="{{ route('search') }}" method="get">

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="category_id">Category: </label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="0">All</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-9">
                        <label for="text">What do you want to find?</label>
                        <input type="text" class="form-control" id="text" name="text">
                    </div>
                    <h5 class="col-md-12">Price</h5>
                    <div class="form-group col-md-2">
                        <label for="price_from">Price from</label>
                        <input type="text" class="form-control" id="price_from" name="price_from">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="price_to">Price to</label>
                        <input type="text" class="form-control" id="price_to" name="price_to">
                    </div>
                    <div class="form-group col-sm-4 offset-4">
                        <label for="btn"></label>
                        <button type="submit" style="width: 100%; font-weight: bold; font-size: 18px" class="btn btn-success" id="btn">Search</button>
                    </div>
                </div>
            </form>
        </div>
            <hr style="margin-bottom: 50px">
{{--     ADS   --}}
            <h2>Ads</h2>
        @foreach($ads as $ad)
            @include('ad.card')
        @endforeach
    </div>
@endsection
