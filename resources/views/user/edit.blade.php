@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <h1 class="border-bottom border-primary">プロフィール編集</h1>
   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="/user/{{ $user->id }}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="EmailInput">Email Address</label>
            <input type="email" name="email" class="form-control" id="EmailInput" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="UserNameInput">User Name</label>
            <input type="text" name="name" class="form-control" id="UserNameInput" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="ProfileInput">Profile</label>
            <textarea rows="3" name="profile" class="form-control" id="ProfileInput" maxlength="100">{{ $user->profile }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
    <form method="POST" action="{{ route('user.destroy', ['user' => $user]) }}" class="nav-item mt-5 text-right">
        @method('DELETE')
        @csrf
        <button class="btn btn-dark btn-sm" type="submit">退会</button>
    </form>
@endsection
