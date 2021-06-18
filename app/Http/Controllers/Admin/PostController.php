<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // VALIDATION
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ], [
            'required' => 'The :attribute is required!',
            'unique' => 'The :attribute is already in use for another post',
            'max' => 'Max :max chcaracters allowed for the attribute',
        ]);

        $data = $request->all();

        // Generate slug
        $data['slug'] = Str::slug($data['title'], '-');

        // Create and sabe record on digits_between
        $new_post = new Post();
        $new_post->fill($data); // <--!!! FILLABLE

        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if(! $post){
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

         if(! $post){
            abort(404);
        }

         return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // VALIDATION
        $request->validate([

            'title' => [
                'required',
                Rule::unique('posts')->ignore($id),
                'Max:255',
            ],
            'content' => 'required',
        ], [
            'required' => 'The :attribute is required!',
            'unique' => 'The :attribute is already in use for another post',
            'max' => 'Max :max chcaracters allowed for the attribute',
        ]);


        $data = $request->all();

        $post = Post::find($id);

        // gen slug
        if($data['title'] != $post->title ){
            $data['slug'] = Str::slug($data['title'],'-');
        }

        $post->update($data); // FILLABLE

        return redirect()->route('admin.posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $post = Post::find($id);
        $post->delete();

        return redirect()->route('admin.post.index')->with('deleted', $post->title);
    }
}
