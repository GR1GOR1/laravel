<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Posts\Save as SaveRequest;

use App\Models\Post;

class Posts extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class);
    }

    public function index()
    {
        // Использовать только в модельках
        // DB::table('posts')->orderBy('title')->('created_at', '2024-01-05');
        // $base = DB::table('posts')->orderBy('title')->('created_at', '2024-01-05');
        // $all = $base->get();
        // $formSite = $base->where('user_id', 1)->get();
        // Можно переиспользовать запрос
        $posts = Post::all();

        // $posts = Post::orderBy();

        return view('posts.index', [
            'posts' => $posts,
            'some' => "Список постов в БД на данный момент."
        ]);
    }

    public function show(Post $post)
    {
        // $posts = Post::findOrFail($id);

        // return view('posts.show', [
        //     'post' => $posts
        // ]);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(SaveRequest $request)
    {
        // $validate = $request->validate([
        //     'title' => 'required|unique:posts|max:25|min:5',
        //     'content' => 'required|max:255|min:5',
        // ]);

        // $fields = $request->all(['title', 'content']); 
               
        // $post = Post::create($request->validated());
        $post = Post::make($request->validated());
        $post->user_id = auth()->id();
        $post->save();
        return redirect("/admin/posts/{$post->id}"); // use named routes DONT USE IN NORMAL CODE!!! ITS STUPIED
    }

    public function destroy() //Делать методом delete
    {

    }

    public function update(SaveRequest $request, Post $post) //Делать методом put
    {
        // $post = Post::findOrFail($id);

        // $validate = $request->validate([
        //     'title' => 'required|unique:posts|max:25|min:5',
        //     'content' => 'required|max:255|min:5',
        // ]);

        //$post->fill() + -> save();
        $post->update($request->validated());
        return redirect()->route('posts.show', [$post->id]);
    }

    public function edit(Post $post)
    {
        // $post = Post::findOrFail($id);

        // return view('posts.edit', [
        //     'post' => $post
        // ]);
        return view('posts.edit', compact('post'));
    }
}
