<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Http\Resources\Comment as CommentResource;
use App\Jobs\UpdatePostDataJob;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request): View
    {
        return view('posts.index', [
            'posts' => Post::search($request->input('q'))
                ->with('author')
                ->withCount('comments')
                ->latest()
                ->paginate(20)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post): View
    {
        $post->comments_count = $post->comments()->count();

        $data = [
            'id' => $post->id,
            'views' => $post->views + 1,
            'comments' => $post->comments_count
        ];
        dispatch(new UpdatePostDataJob($data));

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function category(Request $request, $id): View
    {
        return view('posts.category', [
            'posts' => Post::categories($id)
                ->with('author')
                ->withCount('comments')
                ->latest()
                ->paginate(20)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addComment(CommentsRequest $request)
    {
        $comment = new CommentResource(
            Auth::user()->comments()->create([
                'posted_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'post_id' => $request->input('post_id'),
                'content' => $request->input('content')
            ])
        );
        $post = Post::find($request->input('post_id'));
        return redirect()->route('posts.show', [$post]);
    }
}
