<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\News;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('news.list', array('news' => $news));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Randomize name for filenames that are already taken.
     *
     * @param  string $name
     * @return string $randomName
     */
    private function randomizeName($name) {
        $matches = [];
        /* split filename from extension */
        preg_match("/(\w*)(\.[a-zA-Z]*$)/", $name, $matches);
        
        $rawName = $matches[1];
        $postfix = '_' . rand(1,1000);
        $ext = $matches[2];

        $newName = $rawName . $postfix . $ext;
        /* if this name is taken too, try again .. */
        if(!file_exists(public_path() . '/images/' . $newName)) {
            return $newName;
        } else {
            randomizeName($name);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:news|max:255',
            'file' => 'image|mimes:jpg,jpeg,png,gif|max:' . env('IMAGE_UPLOAD_SIZE_LIMIT') * 1048576 //MB
        ]);

        $news = new News();

        $news->title = $request->input('title');
        $news->content = $request->input('content');

        $images = $request->file("images");
        if($request->hasFile("images")) {
            foreach($images as $ind=>$image) {
                $name = $image->getClientOriginalName();
                /* move file */
                if(!file_exists(public_path() . '/images/' . $name)) {
                    $names[] = $name;
                } else {
                /* file with this name already exists */
                $newName = $this->randomizeName($name);
                    $names[] = $newName;
                }
                /* store original image, thumbnail and 800x600 version */
                $image->move(public_path() . '/images/', $names[$ind]);
                Image::make(public_path() . '/images/' . $names[$ind])->resize(120, 120)->save(public_path() . '/images/thumb/' . $names[$ind]);
                Image::make(public_path() . '/images/' . $names[$ind])->resize(800, 600)->save(public_path() . '/images/800x600/' . $names[$ind]);
            }
            $news->images = json_encode($names);
        } else {
            $news->images = null;
        }

        $news->save();

        return redirect('/news')->with('success', 'News Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        $images = json_decode($news->images);
        return view('news.show', array('news' => $news, 'images' => $images));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $images = json_decode($news->images);
        return view('news.edit', array('news' => $news, 'images' => $images));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255'
        ]);
        $news = News::find($id);

        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->images = $request->input('images');

        $news->save();

        return redirect('/news')->with('success', 'News Updated');
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

        return redirect('/news')->with('success', 'News Removed');
    }
}
