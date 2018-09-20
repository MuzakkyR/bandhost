<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\article;
use auth;

class ArticleController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = article::all();
        
        return view('/after/article', ['article' => $article]);
    }

    public function create()
    {
        return view('/after/create');
    }
    public function store(Request $Request)
    {
        $article = new article;
        $article->title = $Request->title;
        $article->slug = str_slug($Request->title, '-');
        $article->content = $Request->content;
        $article->author = Auth::user()->username;
        $article->save();

        return redirect('/after/article');
    }
    public function edit($id)
    {
        $article = article::find($id);

        return view('/after/edit', ['article' => $article]);

    }
    public function update(Request $Request, $id)
    {
        $article = article::find($id);
        $article->title = $Request->title;
        $article->slug = str_slug($Request->title, '-');
        $article->content = $Request->content;
        $article->save();

        return redirect('/after/article');
    }
    public function destroy($id)
    {
        $article = article::find($id);
        $article->delete();
        return redirect('/after/article');
    }
}
