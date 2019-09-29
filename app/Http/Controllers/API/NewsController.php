<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsResourceCollection;
use App\News;
use Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): NewsResourceCollection
    {
        $news = News::select('title', 'updated_at')->get();
        return new NewsResourceCollection($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $last = News::get('id')->last();
        $id = $last['id'] + 1;
        $images = $request->file("images");
        if(!empty($images)) {
            // dd($images->getClientOriginalName());
            $fileName = "user_image" . rand(1,10000). ".jpg";
            $request->file('images')->move(public_path('/'), $fileName);

            // dd($request->file("images"));
        }

        // foreach($request->file("images") as $image) {
        //     $extension = $image->extension();
        //     $path = $image->path();
        //     $fileName = "user_image.jpg";
        //     // dd($fileName);
        //     $image->move(public_path('/images/'), $fileName);
        //     $picUrl = url('/' . $fileName);
        // }

        // return response()->json(['url' => $picUrl, 'path' => $path], 200);
        // $request->validate([
        //     'title' => 'required',
        //     'content' => 'required'
        // ]);
        // $news = News::create($request->all());
        // $news->save();
        // $images = $request->input('images');
        // // $images = explode(',', $images);
        // if(!empty($images)) {
        //     foreach($images as $image) {
        //         // $image->move(public_path('images'), $image);
        //         Storage::put($image->getClientOriginalName(), file_get_contents($image));
        //     }
        // }

        // $img_path = env('NEWS_IMG_PATH');
        // $img_name = 'foo';
        // $img_ext = '.jpg';


        // Image::make(public_path() . '/images/' . $img_name . $img_ext)->resize(800, 600)->save(public_path() . '/images/' . $img_name . '_800_600' . $img_ext);



        // return new NewsResource($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): NewsResource
    {
        $news = News::select('title', 'content', 'images')->where('id', $id)->get();
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news): NewsResource
    // public function update(Request $request, $id): NewsResource
    {
        $news->update($request->all());

        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
    }
}
