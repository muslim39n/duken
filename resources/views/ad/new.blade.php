@extends('layouts.app')

@section('title_section')New ad @endsection

@section('content')
    <div class="container">
        <form enctype="multipart/form-data" action="{{route('ad.create')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="category">Description</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @if($loop->first) selected @endif>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="">
            </div>

            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
@endsection
