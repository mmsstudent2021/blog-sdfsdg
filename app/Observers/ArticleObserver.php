<?php

namespace App\Observers;

use App\Mail\NewPostMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        logger("U create new Article");

            $receivers = User::where("id", "!=", Auth::id())->limit(3)->get();

            foreach ($receivers as $receiver) {

                logger($receiver->name);

                Mail::to($receiver->email)->later(now()->addMinute(1),new NewPostMail($receiver->name, $article));
            }
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "deleted" event.
     */

    public function deleted(Article $article): void
    {
        logger("U deleted new Article");

    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        //
    }
}
