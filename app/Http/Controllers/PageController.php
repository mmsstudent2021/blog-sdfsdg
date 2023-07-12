<?php

namespace App\Http\Controllers;

use App\Mail\FirstMail;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class PageController extends Controller
{

    public function mailTest(){
        Mail::to("mmsstudent2021@gmail.com")->send(new FirstMail("I'm title"," I'm description"));
        return "aung p";
    }

    public function validateTest(){
        $date = Carbon::now();
        $startDate = Carbon::now()->subMonths(3);

        $period = CarbonPeriod::create($startDate,$date);

        return $period;
        // return view('validate-test');
    }

    public function validateCheck(Request $request){

        $request->validate([
            // "title" => "required",
            // "gender" => "required|in:male,female,other",
            // "township" => "required|exists:townships,name",
            // "skills" => "required|array|max:3",
            // "skills.*" => "exists:skills,title",
            // "photo" => "required|file|max:1024|mimes:jpg,png|dimensions:max_width=1000",
            // "certificates" => "required|array|max:3",
            "certificates.*" => "file|max:1024|mimes:jpg,png"
        ]);
        return $request;
    }








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
