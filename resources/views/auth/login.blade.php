@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<h1 class="border-bottom border-primary">ログイン</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label for="EmailInput">Email Address</label>
            <input type="e-mail" name="email" class="form-control" id="EmailInput" placeholder="hoge@example.com">
        </div>
        <div class="form-group">
            <label for="PasswordInput">Password</label>
            <input type="password" name="password" class="form-control" id="PasswordInput">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="Remember" value="1">
            <label class="form-check-label" for="Remember">ログインしたままにする</label>
        </div>
        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>
@endsection
