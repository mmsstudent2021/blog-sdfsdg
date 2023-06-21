<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;
                $builder->where("title", "like", "%" . $keyword . "%");
                $builder->orWhere("description", "like", "%" . $keyword . "%");
            });
        })
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where("user_id", Auth::id());
            })
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy("title", $sortType);
            })
            // ->dd()
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

        $savedThumbnail = null;
        if($request->hasFile('thumbnail')){
            // dd($request->file('thumbnail')->extension());
            $savedThumbnail = $request->file("thumbnail")->store("public/thumbnail");
            // $thumbnail = $request->file("thumbnail");
            // $savedThumbnail = $thumbnail->storeAs("public","hello.".$thumbnail->extension());
            // $request->thumbnail;
            // return $savedThumbnail;
        }
        // return $request;
        $article = Article::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "description" => $request->description,
            "excerpt" => Str::words($request->description,30,"..."),
            "category_id" => $request->category,
            "thumbnail" => $savedThumbnail,
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
            "slug" => Str::slug($request->title),
            "description" => $request->description,
            "excerpt" => Str::words($request->description,30,"..."),
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
