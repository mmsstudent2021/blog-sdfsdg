<?php

namespace App\Models;

use App\Mail\NewPostMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["title", "slug", "description", "excerpt", "thumbnail", "category_id", "user_id"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    // protected static function booted(): void
    // {
    //     static::created(function (Article $article) {

    //         $receivers = User::where("id", "!=", Auth::id())->limit(3)->get();

    //         foreach ($receivers as $receiver) {

    //             logger($receiver->name);

    //             // Mail::to($receiver->email)->send(new NewPostMail($receiver->name, $article));
    //         }
    //     });

    //     static::deleting(function(Article $article){
    //         logger("U are deleting");
    //     });

    //     static::deleted(function(){
    //         logger("U are deleted");
    //     });
    // }
}
