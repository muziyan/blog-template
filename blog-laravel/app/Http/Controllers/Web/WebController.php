<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\Carousel;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{

    public function index(){
        $articles = Article::orderBy("article_hit","desc")->paginate(5);

        return view("web.index",[
            "articles" => $articles
        ]);
    }

    public function article($article){

        $article = Article::find($article);

        $prev = Article::where("id","<",$article->id)
                        ->orderBy("id",'desc')
                        ->first();


        $next  = Article::where("id",">",$article->id)
                        ->orderBy("id",'asc')
                        ->first();

        return view("web.article",[
            "article" => $article,
            "prev" => $prev,
            "next" => $next
        ]);

    }

    public function search_article(Request $request){
        $echostr = $request['search_article'];

        $articles = Article::where("article_title",$echostr)->orWhere("article_title","like","%".$echostr."%")->paginate(5);

        return view("web.index",[
            "articles" => $articles
        ]);

    }

    public function update_hit($article_id){

        $article = Article::find($article_id);
        $article->article_hit += 1;
        $article->save();

    }
}
