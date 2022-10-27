<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::paginate(10);

        return view('article.index',compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request,[
                'title' => 'required|min:5|max:100',
                'content' => 'required',
                'article_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'article_creator' => 'required'
            ]);

            $extension  = $request->file('article_image')->extension();
            $imageName  = date('ymdhis').'.'.$extension;
            $path       = Storage::putFileAs('public/images', $request->file('article_image'), $imageName);
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'article_image' => $path,
                'article_creator' => $request->article_creator
            ]);

            return redirect()->route('article.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit',compact('article'));
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
        try {
            $this->validate($request,[
                'title'             => 'required|min:5|max:100',
                'content'           => 'required',
                'article_image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'article_creator'   => 'required'
            ]);
            $article    = Article::find($id);
            if ($request->file('article_image')) {
                $extension  = $request->file('article_image')->extension();
                $imageName  = date('ymdhis').'.'.$extension;
                $path       = Storage::putFileAs('public/images', $request->file('article_image'), $imageName);
            } else {
                $path  = $article->article_image;
                unset($request->image);
            }
            $article->title             = $request->title;
            $article->content           = $request->content;
            $article->article_image     = $path;
            $article->article_creator   = $request->article_creator;
            $article->update();

            return redirect()->route('article.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Article::find($id)->delete();

            return back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
