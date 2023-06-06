<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $articles = Article::when(request()->has("keyword"), function ($query) {
            $keyword = request()->keyword;
            $query->where("title", "like", "%" . $keyword . "%");
            $query->orWhere("description", "like", "%" . $keyword . "%");
        })
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy("title", $sortType);
            })
            ->latest("id")
            ->paginate(10)->withQueryString();

        return view("welcome", compact('articles'));
    }

    public function show($id){
        $article = Article::findOrFail($id);
        return view('detail',compact('article'));
    }
}
