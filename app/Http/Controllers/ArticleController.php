<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::when(request()->has("keyword"), function ($query) {
            $keyword = request()->keyword;
            $query->where("title", "like", "%" . $keyword . "%");
            $query->orWhere("description", "like", "%" . $keyword . "%");
        })
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where("user_id", Auth::id());
            })
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy("title", $sortType);
            })
            ->latest("id")
            ->paginate(7)->withQueryString();

        return view("article.index", compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            "title" => $request->title,
            "description" => $request->description,
            "category_id" => $request->category,
            "user_id" => Auth::id()
        ]);
        return redirect()->route("article.index")->with("message", $article->title . " is created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // if (!Gate::allows("article-update", $article)) {
        //     return abort(403, "ပေးမသုံးဘူးကွာ၊မဆိုးနဲ့ကွာ");
        // }
        // if(Gate::denies('article-update',$article)){
        //     return abort(403);
        // }

        Gate::authorize('update', $article);

        $article->update([
            "title" => $request->title,
            "description" => $request->description,
            "category_id" => $request->category
        ]);

        return redirect()->route("article.index")->with("message", $article->title . " is updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize("delete", $article);
        $article->delete();
        return redirect()->route("article.index")->with("message", "Article is deleted");
    }
}
