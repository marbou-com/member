<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //dd($request->query('post_id'));
        //if($request->has('post_id')){

            $post_id = $request->query('post_id');
            return view('comments.create', ['post_id' => $post_id]);

            //$posts=Post::where('category_id' , $post_id)->get();
            //$posts->load('category', 'user');//カテゴリ名、ユーザー名取得
            //dd($posts);
        //}else{
        //    $posts=Post::all();
        //    $posts->load('category', 'user');//カテゴリ名、ユーザー名取得
            //dd($posts);
        //}

        //return view('posts.index', ['posts' => $posts]);    

        //$request->input('post_id');
        //dd($request);
        //return view('comments.create', [$request]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $id = Auth::id();//IDだけ取得
        
        //インスタンス作成
        $comment = new Comment();
        
        
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = $id;

        $comment->save();

       return redirect()->route('post.show', ['post'=>$request->post_id])->with('message', '投稿しました');


       //return view('post.show',compact('post'));

       //return view('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
