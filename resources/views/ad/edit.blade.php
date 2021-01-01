@extends('layouts.app')

@section('title_section')Edit @endsection

@section('content')
    <div class="container">
        <h2>Edit ad</h2>
        <form action="{{route('ad.edit_post')}}" method="post">
            @csrf
            <input type="text" hidden name="id" value="{{$ad->id}}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder=""
                value="{{$ad->name}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{$ad->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @if($ad->category->id == $cat->id) selected @endif>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(Auth::user()->isModerator())
                <div class="form-group">
                    <label for="name">Message</label>
                    <input type="text" class="form-control" id="message" name="message" placeholder="">
                </div>
            @endif
            <div class="form-group">
                <label for="name">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Example input"
                value="{{$ad->price}}">
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
@endsection
