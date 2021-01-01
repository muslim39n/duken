@extends('layouts.app')

@section('title_section')Status @endsection

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">*</th>
                <th scope="col">*</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->isAdmin())
                            <span style="color: #e3342f">Admin</span>
                        @else
                            <a href="{{ route('admin.give_role_get', [$user->id, 1]) }}" type="button" class="btn btn-danger">Give admin status</a>
                        @endif
                    </td>
                    <td>
                        @if($user->isModerator())
                            <span style="color: #38c172">Moderator</span>
                        @else
                            <a href="{{ route('admin.give_role_get', [$user->id, 2]) }}" type="button" class="btn btn-success">Give moderator status</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
