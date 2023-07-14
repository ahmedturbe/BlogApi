<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $post->image = [
                'path' => $imagePath,
                'url' => Storage::url($imagePath),
            ];
        }

        $post->save();

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            // Delete image if exist
            if ($post->image) {
                Storage::delete($post->image['path']);
            }

            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $post->image = [
                'path' => $imagePath,
                'url' => Storage::url($imagePath),
            ];
        }

        $post->save();

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Delete image if exist
        if ($post->image) {
            Storage::delete($post->image['path']);
        }

        $post->delete();

        return response()->json(['message' => 'Post successfully deleted']);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('content', 'like', '%' . $search . '%')
        ->orWhere('title', 'like', '%' . $search . '%')->get();
        return response()->json($posts);
    }
    public function sort(Request $request)
    {
        $query = Post::query();

    // Provjerite da li je dostupan parametar za sortiranje
    if ($request->has('sort_by')) {
        $sortField = $request->input('sort_by');
        $sortOrder = $request->input('sort_order', 'asc');

        // Provjerite podržana polja za sortiranje
        if ($sortField === 'title') {
            $query->orderBy('title', $sortOrder);
        } elseif ($sortField === 'created_at') {
            $query->orderBy('created_at', $sortOrder);
        }
    }

    $posts = $query->get();

    return response()->json($posts);
    }

}
