@extends('layouts.app')

@section('title', 'tutorial-chat')

@section('content')
<div class="container bg-light pt-5 pb-5">
    <div class="card bg-light">
        <ul class="list-group list-group-flush">
            @foreach($posts as $post)
            <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $post->user->name }}</h5>
                </div>
                @if(Auth::id() == $post->user_id)
                    <form method="POST" action="/posts/{{ $post->id }}" class="float-right">
                        @method('DELETE')
                        @csrf
                        <button>×</button>
                    </form>
                @endif
                <div>{{ $post->body }}</div>
            </li>
            @endforeach
        </ul>
    </div>
    <form method="POST" action="/posts" class="form-inline mt-5">
        @csrf
        <textarea rows="1" name="body" class="form-control mr-sm-2 col-sm-10" maxlength="100"></textarea>
        <button type="submit" class="btn btn-primary my-2 col-sm-1">投稿</button>
    </form>
</div>
@endsection
