<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $articles = Article::when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;
                $builder->where("title", "like", "%" . $keyword . "%");
                $builder->orWhere("description", "like", "%" . $keyword . "%");
            });
        })
            ->when(request()->has('category'),function($query){
                $query->where("category_id",request()->category);
            })
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy("title", $sortType);
            })
            // ->dd()
            ->latest("id")
            ->paginate(10)->withQueryString();

        return view("welcome", compact('articles'));
    }

    public function show($slug){
        $article = Article::where("slug",$slug)->firstOrFail();
        return view('detail',compact('article'));
    }

    public function categorized($slug)
    {
        $category = Category::where("slug",$slug)->firstOrFail();
        return view('categorized',[
            "category" => $category,
            "articles" => $category->articles()->when(request()->has("keyword"), function ($query) {
                $query->where(function (Builder $builder) {
                    $keyword = request()->keyword;
                    $builder->where("title", "like", "%" . $keyword . "%");
                    $builder->orWhere("description", "like", "%" . $keyword . "%");
                });
            })->paginate(10)->withQueryString()
        ]);
    }
}
