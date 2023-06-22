<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            $savedPhotos = [];
            foreach ($photos as $photo) {
                $savedPhoto = $photo->store("public/photo");
                $savedPhotos[] = [
                    "article_id" => $request->article_id,
                    "address" => $savedPhoto,
                    "created_at" => now(),
                    "updated_at" => now()

                ];
            }
            Photo::insert($savedPhotos);


            //  foreach($photos as $photo){
            //     $savedPhoto = $photo->store("public/photo");
            //     $savedPhotos [] = [ "address" => $savedPhoto];
            //  }
            //  $article->photos()->createMany($savedPhotos);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->back();
    }
}
