<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;//バリデーション

class postController extends Controller
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
     * 新規作成画面を表示する
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     * 新規投稿した情報をDB追加する
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $user=Auth::user();

        $image_path="";//画像ファイル
        if($request->hasFile('image')){//ファイルが送信されたか
            if($request->file('image')->isValid()){//ファイルがアップロードされたか
                //①Starageファサード
                //$image_path = Storage::put('/public/images/', $request->file('image'));
                
                //②通常
                $image_path = $request->file('image')->store('public/images');
                //dd($image_path);
                $image_path=basename($image_path);
                //dd($image_path);

            }
        }


        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        
        $post->image=$image_path;
        //dd($user);
        $post->user_id=$user->id;
        $post->save();

        //①フラッシュメッセージ
        \Session::flash('message', '投稿が完了しました！！！');
        //return redirect()->route('post.create');

        //②フラッシュメッセージ
        return redirect()->route('post.create')->with('message', '投稿しました');

        //参考
        /*
        * https://codelikes.com/laravel-redirect/
        * https://qiita.com/usaginooheso/items/6a99e565f16de2f9ddf7
        */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$post=Post::where('id',$id)->get();複数形の取得なのでforeach用
        $post=Post::where('id',$id)->first();
        $post->load( 'user' ,'comments' );

        //dd($post);
        return view('post.show',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::where('id',$id)->first();
        return view('post.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {

        $image_path="";//画像ファイル
        if($request->hasFile('image')){//ファイルが送信されたか
            if($request->file('image')->isValid()){//ファイルがアップロードされたか
                //①Starageファサード
                //$image_path = Storage::put('/public/images/', $request->file('image'));
                
                //②通常
                $image_path = $request->file('image')->store('public/images');
                $image_path=basename($image_path);

            }
        }
              
        /*()使う方法*/
        Post::where('id',$id)->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$image_path
        ]);

        /*②save()使う方法*/
        //$post->title=$request->title;
        //$post->body=$request->body;
        //$post->image=$image_path;
        
        //$post->save(); 

        return redirect()->route('post.edit', ['post'=>$id])->with('message', '投稿しました');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect()->route('home')->with('message', '投稿しました');

    }
}
