<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\article;

class IndexController extends Controller
{
    public function index()
    {
        $artikel = article::OrderBy('created_at', 'desc')
               ->paginate(4);
        return view('index', ['artikel' => $artikel]);
    }
    public function show($slug)
    {
        $artikel = article::where('slug', $slug)->first();

        return view('view', ['artikel' => $artikel]);
    }
}
