<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(
            Post::with(['category:id,name', 'user:id,name,email'])
                ->latest()
                ->get()
        );
    }

    public function show($id)
    {
        $post = Post::with(['category:id,name', 'user:id,name,email'])->findOrFail($id);
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $post = Post::create([
            'title'       => $data['title'],
            'content'     => $data['content'],
            'category_id' => $data['category_id'],
            'user_id'     => $request->user()->id, 
        ]);

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $post->update($data);

        return response()->json($post);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['success' => true]);
    }
}
