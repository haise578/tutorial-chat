@extends('layouts.app')

@section('title', '会員登録')

@section('content')
    <h1 class="border-bottom border-primary">会員登録</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="/register">
        @csrf
        <div class="form-group">
            <label for="EmailInput">Email Address</label>
            <input type="e-mail" name="email" class="form-control" id="EmailInput" placeholder="hoge@example.com">
        </div>
        <div class="form-group">
            <label for="UserNameInput">User Name</label>
            <input type="text" name="name" class="form-control" id="UserNameInput">
        </div>
        <div class="form-group">
            <label for="PasswordInput">Password</label>
            <input type="password" name="password" class="form-control" id="PasswordInput">
        </div>
        <div class="form-group">
            <label for="PasswordConfirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" id="PasswordConfirmation">
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@endsection
