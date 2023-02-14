<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest();
        $categories = Category::all();
        $sellers = User::all();

        if (request('search')) {
            $posts
                ->orWhere('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%')
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                });
        }

        return view('posts', [
            'posts' => $posts->filter(request(['search']))->get(),
            'categories' => $categories,
            'sellers' => $sellers]);
    }

    public function sortPosts(Request $request)
    {
        $categories = Category::all();

        $sortOrder = $request->input('sort');
        if ($sortOrder === 'asc') {
            $posts = Post::orderBy('created_at', 'asc')->get();
        } elseif ($sortOrder === 'desc') {
            $posts = Post::orderBy('created_at', 'desc')->get();
        } else {
            $posts = Post::all();
        }

        return view('posts', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IlluminateHttpRequest $request
     * @return IlluminateHttpResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|regex:/^[0-9]+.[0-9]+$/',
            'body' => 'required|min:30',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'images' => 'required',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $images = $request->images;

        $post = Post::create([
            'user_id' => auth()->id(),
            'uuid' => Str::orderedUuid(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            'body' => $request->body
        ]);
        foreach ($images as $image) {
            $photo = Photo::create([
                'uuid' => Str::orderedUuid(),
                'post_id' => $post->id,
                'extension' => $image->extension()
            ]);
            $image->storeAs('public/posts/images', $photo->uuid . '.' . $image->extension());
        }

        return redirect('/')->with('success', 'Post Added Successfully.');
    }
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }
    public function update(Request $request, Post $post)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'price' => 'required|regex:/^[0-9]+.[0-9]+$/',
            'body' => 'required|min:30',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        if ($request->hasFile('images')) {
            Photo::where('post_id', $post->id)->delete();

            $images = $request->images;

            foreach ($images as $image) {
                $photo = Photo::create([
                    'uuid' => Str::orderedUuid(),
                    'post_id' => $post->id,
                    'extension' => $image->extension()
                ]);
                $image->storeAs('public/posts/images', $photo->uuid . '.' . $image->extension());
            }
        }

        $postData = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            'body' => $request->body,
        ];

        $post->update($postData);

        return back()->with('success', 'Post Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AppModelsPost $post
     * @return IlluminateHttpResponse
     */
    public function destroy(Post $post)
    {
        Storage::delete('public/images/' . $post->file);
        $post->delete();
        return redirect('/')->with('success', 'Post Deleted.');
    }
}
