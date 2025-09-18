<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category:id,name', 'user:id,name,email'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('admin.posts.create', compact('categories'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post deleted');
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'id'          => ['nullable', 'integer', 'exists:posts,id'],
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $userId = auth()->id() ?? \App\Models\User::query()->value('id');

        if (!empty($data['id'])) {
            $post = Post::find($data['id']);
            $post->update([
                'title'       => $data['title'],
                'content'     => $data['content'],
                'category_id' => $data['category_id'],
            ]);
        } else {
            Post::create([
                'title'       => $data['title'],
                'content'     => $data['content'],
                'category_id' => $data['category_id'],
                'user_id'     => $userId,
            ]);
        }

        return redirect()->route('posts.index')->with('status', 'Post saved');
    }
}
