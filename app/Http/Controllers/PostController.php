<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->index();
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
            'title'=>'required|max:64',
            'author'=>'required|max:24'
        ]);

        $post = new Post([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'author' => $request->get('author'),
            'upvotes' => 0,
            'downvotes' => 0,
            'category' => $request->get('category')
        ]);

        $post -> save();
        return redirect('/posts')->with('success', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id->empty())
            return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

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
        $post = Post::find($id);
        $votes = 0;
        if($request->get("type")=="upvote"){
            $votes =  $post->upvotes;
            $post->upvotes = $votes + 1;
            $post -> save();
            $votes = $post->upvotes;
        }
        else if ($request->get("type")=="downvote"){
            $votes =  $post->downvotes;
            $post->downvotes = $votes + 1;
            $post -> save();
            $votes =  $post->downvotes;
        }
        
        return response()->json(['votes' => $votes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
