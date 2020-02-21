<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticlePost;
use App\Models\Article;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $articles = Article::paginate(10);
        $sections = Section::all();

        return view("admin.article",[
            "articles" => $articles,
            "sections" => $sections,
            "show_list" => true,
            "update_data" => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ArticlePost $request)
    {
        $validated = $request->validated();
        $file_path = $this->uploadImage($request['article_image'],'articles_image');
        $validated['article_image'] = $file_path;
        Article::create($validated);
        return $this->showSuccess("admin/article",[
            "show_list" => false,
            "notice" => "create article success!"
        ]);

    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Article $article)
    {
        if ($article){
            $articles = Article::paginate(10);
            $sections = Section::all();

            return view("admin.article",[
                "articles" => $articles,
                "sections" => $sections,
                "show_list" => true,
                "update_data" => $article
            ]);
        }

        return $this->showNotFound("admin/article");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Article $article)
    {
        if ($article){

            $req = $request->all();
            if ($request['article_image']){
                $file_path = $this->uploadImage($request['article_image'],'article_image');
                $req['article_image'] = $file_path;

            }else{
                unset($req['article_image']);
            }

            $article->update($req);

            return $this->showSuccess("admin/article")->with([
                "show_list" => false,
                "notice" => "update article success!"
            ]);
        }

        return $this->showNotFound("admin/article");
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Article $article)
    {
        if ($article){
            $article->delete();
            return $this->showSuccess("admin/article")->with([
                "show_list" => false,
                "notice" => "delete article success!"
            ]);
        }

        return $this->showNotFound("admin/article");
    }
}
