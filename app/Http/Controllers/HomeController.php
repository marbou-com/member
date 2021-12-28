<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;//ページネーション


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * 一覧表示
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=Post::orderBy('updated_at', 'desc')->paginate(3);

        //dd(url()->current());
        $posts->load( 'user' );


        //dd($posts);
        //compact：表示する画面の中に変数を受け渡す
        //view('ルート名', compact(変数名）)：表示する画面に変数を受け渡す

        return view('home', compact('posts'));    }
}
