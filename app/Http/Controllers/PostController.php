<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PostInterface;

class PostController extends Controller
{

    protected $postRepository;

    public function __construct(PostInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getAll();
        return view('post.index')->with([
            'posts' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => ['required', 'string', 'max:100'],
        ]);
        $this->postRepository->create($validatedData['body'], Auth::id());
        return redirect()->action('PostController@index');
    }

    public function destroy(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            return abort(403);
        }
        $post->delete();
        return redirect()->action('PostController@index');
    }
}
