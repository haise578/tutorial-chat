@extends('layouts.app')

@section('title', 'ユーザー情報')

@section('content')
    <h1 class="border-bottom border-primary">ユーザー情報</h1>
    <div class="form-group">
        <label for="EmailInput">Email Address</label>
        <input type="email" name="email" class="form-control" disabled="disabled" id="EmailInput" value="{{ $user->email }}">
    </div>
    <div class="form-group">
        <label for="UserNameInput">User Name</label>
        <input type="text" name="name" class="form-control" disabled="disabled" id="UserNameInput" value="{{ $user->name }}">
    </div>
    <div class="form-group">
    <label for="ProfileInput">Profile</label>
        <textarea rows="3" name="name" class="form-control" disabled="disabled" id="ProfileInput" maxlength="100">{{ $user->profile }}</textarea>
    </div>
    @if(Auth::id() == $user->id)
    <a href="{{ route('user.edit', ['user' => $user]) }}" class="mr-auto">
        <button type="button" class="btn btn-primary">更新</button>
    </a>
    @endif
@endsection
