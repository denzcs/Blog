<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->anons = $request->anons;
        $post->content = $request->content;
        $path = Storage::disk("public")->putFile('/photo', $request->file("photo"));
        $post->photo = $path;
        $post->save();
        return response()->json(["id" => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        $post = Post::with('user')->withCount('likes', 'comments')->findOrFail($post);
        $comments = Comment::where('post_id', $post->id)->with('user')->get();
        $isLike = false;
        $isAdmin = false;
        if (Auth::check()) {
            if (Auth::user()->id == $post->user_id || Auth::user()->role == 'admin') {
                $isAdmin = true;
            }
            $like = Like::where("post_id",$post->id)->where("user_id", Auth::id())->first();
            if ($like) {
                $isLike = true;
            }
        }

        return response()->json(['post' => $post, 'comments' => $comments, 'isAdmin' => $isAdmin, 'isLike' => $isLike]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->anons = $request->anons;
        $post->content = $request->content;
        if ($request->has("photo")) {
            $path = Storage::disk("public")->putFile('/photo', $request->file("photo"));
            $post->photo = $path;
        }
        $post->save();
        return response()->json(["id" => $post->id]);
    }
    public function postUser(User $user)
    {
        return Post::where("user_id", $user->id)->orderBy('created_at', 'desc')->with("user")->withCount("comments", "likes")->paginate(2);
    }
    public function getPosts()
    {
        return Post::with("user")->orderBy('created_at', 'desc')->withCount("comments", "likes")->paginate(2);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function getSideBarPosts()
    {
        return Post::with('user')->orderBy('likes', 'desc')->orderBy('comments', 'desc')->get();
    }
}
