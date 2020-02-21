@extends("web.layouts.app")


@section("content")
        <!-- article section  -->
        <section id="article">
            <div class="container-sm">
                <div class="row">
                    @foreach($articles as $article)
                    <div class="col-lg-7 mb-3 pl-5 pr-5" style="margin: auto">
                        <div class="card">
                            <img src="{{asset($article->article_image)}}" class="card-img-top" alt="">
                            <div class="card-body">
                                <a href="{{route("article",["article" => $article->id])}}" class="card-title pb-3">{{$article->article_title}}</a>
                                <p class="card-text markdown-preview">
                                    <textarea class="markdown-text">{{Illuminate\Support\Str::limit($article['article_content'],300)}}</textarea>
                                </p>
                                <a href="{{route("article",["article" => $article->id])}}" class="btn btn-primary mt-3">更多</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <script src="{{asset("assert/admin/markdown/markdown.js")}}"></script>
                    <script>
                        document.querySelectorAll(".markdown-text").forEach(v =>{
                            v.parentElement.innerHTML = markdown.toHTML(v.value)
                        })
                    </script>
                </div>
                {{$articles->links()}}
            </div>
        </section>

    <!-- photo section -->
{{--    <section id="photos">
        <div class="container">
            <div class="title-box">
                <h3 class="title">photos</h3>
                <p class="title-description">this is a description part</p>
            </div>
            <!-- waterfalls flow -->
            <div class="waterfalls">
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
                <div class="waterfalls-item">
                    <img src="{{asset("assert/web/images/banner.jpg")}}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </section>--}}

    <!-- paragraph section -->
    <!--    <section id="paragraph">
            <div class="container">
                <div class="title-box">
                    <h3 class="title">paragraph</h3>
                    <p class="title-description">This is a description part</p>
                </div>
                <div class="row">

                </div>
            </div>
        </section>-->
    @stop
<script>
    fetch("{{asset("/")}}api/access");

</script>
