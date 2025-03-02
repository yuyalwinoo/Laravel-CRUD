<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated);
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {//dd($request->all());
        $post = Post::findOrFail($id);
        
        return view('posts.create',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
           'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'title')->ignore($id, 'id'),
            ],
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('posts.create')->withErrors($validator)->withInput();

        }
        $validatedData = $validator->validated();

        try{
            $post = Post::findOrFail($id);
            $post->update($validatedData);
            return redirect()->route('posts.index')->with('success', 'Post updated successfully!');

        }catch (ModelNotFoundException $e) {

            return redirect()->route('posts.index')->withErrors('errors', 'Data not found');
        }catch (\Exception $e) {

            return redirect()->route('posts.index')->withErrors('errors', $e);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $post = Post::findOrFail($id);
            $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
        }catch(\Exception $e){
            dd($e);
        }
        
    }
}
