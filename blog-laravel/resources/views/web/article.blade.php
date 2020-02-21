@extends("web.layouts.app")


@section("content")

    <!-- main -->
    <main>

        <section id="article-content">
            <div class="container" >
                <div style="width:80%;margin:auto">
                    <img src="{{asset($article->article_image)}}" alt="" class="w-100 mb-5">
                    <h2 class="title text-center">{{$article->article_title}}</h2>
                    <div class="info text-center">
                        <span class="author"><i data-feather="user"></i>{{$article->article_author}}</span>
                        <span class="date"><i data-feather="clock"></i>{{$article->created_at}}</span>
                        <span class="look"><i data-feather="eye"></i>{{$article->article_hit}}</span>
                    </div>
                    <div class="main-content markdown-preview">
                    <textarea
                        class="markdown-text">{{Illuminate\Support\Str::limit($article['article_content'],300)}}</textarea>
                    </div>
                    <div id="pagination" class="mt-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a type="button" class="btn btn-outline-info {{!$prev ? "disabled" : ''}}" href="{{$prev ? route("article",["article"=>$prev->id]) : ""}}"><i
                                            data-feather="arrow-left"></i>{{ $prev ? $prev->article_title : "没有上一篇" }}</a>
                                </div>
                                <div class="col-6 text-right">
                                    <a type="button" class="btn btn-outline-info {{!$next ? "disabled" : ''}}" href="{{$next ? route("article",["article"=>$next->id]) : ""}}">{{ $next ? $next->article_title : "没有下一篇" }}<i
                                            data-feather="arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{asset("assert/admin/markdown/markdown.js")}}"></script>
            <script>
                document.querySelectorAll(".markdown-text").forEach(v => {
                    v.parentElement.innerHTML = markdown.toHTML(v.value)
                })

                fetch("{{route("update_hit",['id' => $article->id])}}")

            </script>
        </section>

        <!-- article content section -->

        <!-- pagination section -->
    </main>

@stop

