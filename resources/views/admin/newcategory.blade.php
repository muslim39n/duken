@extends('layouts.app')

@section('title_section')New category @endsection

@section('content')
    <div class="container">
        <form action="{{ route('admin.new_category_post') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Category:</label>
                <input required type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="name">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
