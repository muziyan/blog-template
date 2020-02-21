<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>season blog Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assert/admin/css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section("style")
        @stop
</head>
<body>
<!-- header -->
<header>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route("admin.home")}}">Season</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{route("logout")}}">Sign out</a>
            </li>
        </ul>
    </nav>
</header>

<!-- main -->
<main>
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <div class="main-sidebar col-2 bg-light">
                <ul class="nav">
                    <li class="nav-item {{$url_path == "/" ? "active" : ""}} w-100">
                        <a href="{{route("admin.home")}}" class="nav-link"><i data-feather="home" class="info"></i>首页</a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="{{route("user.index")}}" class="nav-link {{$url_path == "user" ? "active" : ""}} {{$url_path == "user" ? "active" : ""}}"><i data-feather="user" class="info"></i>用户管理</a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="{{route("carousel.index")}}" class="nav-link {{$url_path == "carousel" ? "active" : ""}}"><i data-feather="image" class="info"></i>轮播管理</a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="{{route("section.index")}}" class="nav-link {{$url_path == "section" ? "active" : ""}}"><i data-feather="bookmark" class="info"></i>栏目管理</a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="{{route("article.index")}}" class="nav-link {{$url_path == "article" ? "active" : ""}}"><i data-feather="book" class="info"></i>文章管理</a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="{{route("photo.index")}}" class="nav-link {{$url_path == "photo" ? "active" : ""}}"><i data-feather="image" class="info"></i>相册管理</a>
                    </li>
                </ul>
            </div>
            {{-- alert message --}}
            @include("shared._flash")
            <!-- main content -->
            <div class="main-content col-9">
                @yield("content")
            </div>
        </div>
    </div>
</main>

<!-- footer -->
<footer class="back">
    <div class="container">
        <p class="text-center">O Troupe of little vagrants of the world, leave your footprints in my words.</p>
        <p class="text-center">Email:997432833@qq.com</p>
        <p class="text-center">&copy;copyright 2020-2-11 season </p>
    </div>
</footer>
</body>
<script src="{{asset("assert/admin/js/jquery-3.4.1.js")}}"></script>
<script src="{{asset("assert/admin/js/paste-upload-image.js")}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!-- font -->
<script src="https://unpkg.com/feather-icons"></script>
<script src="{{asset("assert/admin/markdown/markdown.js")}}"></script>
<script src="{{asset("assert/admin/js/laravel.js")}}"></script>
<script>

    //初始化字体
    feather.replace();

    setTimeout(()=>{
        $('.alert').alert("close");
    },2000)


    /* 图片上传预览 */
    function showPreview(source,imgClass) {
        let file = source.files[0];
        if (window.FileReader){
            let fr = new FileReader();
            fr.onloadend = function (e) {
                document.querySelector(imgClass).src = e.target.result
            }
            fr.readAsDataURL(file)
        }
    }

    /* mark down 编辑器 */
    function Editor(input, preview) {
        this.update = function () {
            preview.innerHTML = markdown.toHTML(input.value);
        };
        input.editor = this;
        this.update();
    }
    function EditorInit(textarea,preview){
        new Editor(document.querySelector(textarea), document.querySelector(preview));
    }




</script>
@section("script")@show
</html>
