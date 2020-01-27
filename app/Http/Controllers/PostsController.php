<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $count = Post::count();
        return view('posts.index')->with('posts', $posts)->with('count', $count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' =>  'required|max:200',
            'body' => 'required|max:500',
            'coverImage' => 'image|mimes:jpeg,bmp,png|max:1999'
        ]);
        if ($request->hasFile('coverImage')) {
            $file = $request->file('coverImage');
            $ext = $file->getClientOriginalExtension();
            $filename = 'cover_image' . '_' . time() . '.' . $ext;
            $file->storeAs('public/coverImages', $filename);
        } else {

            $filename = 'noimage.png';
        }
        $post = new Post();
        $post->title =  $request->title;
        $post->body =  $request->body;
        $post->user_id = auth()->user()->id;
        $post->image = $filename;
        $post->save();

        return redirect('/posts')->with('status', 'Post was created !');
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
        return view('posts.show')->with('post', $post);
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
        if (Auth()->user()->id !== $post->user_id) {
            return redirect(route('posts'))->with('error', ' You are not authorized');
        }
        return view('posts.edit')->with('post', $post);
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
        $request->validate([

            'title' =>  'required|max:200',
            'body' => 'required|max:500',
            'coverImage' => 'image|mimes:jpeg,bmp,png|max:1999'
        ]);

        if ($request->hasFile('coverImage')) {

            $file = $request->file('coverImage');
            $ext = $file->getClientOriginalExtension();
            $filename = 'cover_image' . '_' . time() . '.' . $ext;
            $file->storeAs('public/coverImages', $filename);
        } else {
            $filename = 'noimage.png';
        }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $filename;
        $post->save();

        return redirect('/posts')->with('status', 'Post was updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('status', 'Post was delete !');
    }
}
