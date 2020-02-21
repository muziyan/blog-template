@extends("admin.layouts.app")

@section("style")
    <link rel="stylesheet" href="{{asset("assert/markdown-css/vue.css")}}">
@show

@section("content")

    <div class="border-bottom">
        <h3 class="h3">文章管理</h3>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ session("show_list") && !$update_data ? "active" : "" }}" id="add-tab" data-toggle="tab" href="#user-add" role="tab" aria-controls="home" aria-selected="true">文章添加</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ !session("show_list") && !$update_data ? "active" : "" }}" id="profile-tab" data-toggle="tab" href="#user-list" role="tab" aria-controls="profile" aria-selected="false">文章列表</a>
        </li>
        @if($update_data)
            <li class="nav-item">
                <a class="nav-link active" id="edit-tab" data-toggle="tab" href="#user-edit" role="tab" aria-controls="profile" aria-selected="false">文章修改</a>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- 文章添加 -->
        <div class="tab-pane fade {{ session("show_list") && !$update_data ? "show active" : "" }}" id="user-add" role="tabpanel" aria-labelledby="add-tab">
            <form class="mt-3" method="post" action="{{route("article.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="article-name">文章标题:</label>
                    <input type="text" class="form-control w-50" id="article-name" name="article_title">
                </div>
                <div class="form-group">
                    <label for="author">文章作者:</label>
                    <input type="text" class="form-control w-50" id="author" name="article_author" value="季七。">
                </div>
                <div class="form-group">
                    <label for="section-id">文章栏目:</label>
                    <select class="form-control form-control-sm w-25" id="section-id" name="section_id">
                        @foreach($sections as $section)
                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="hit">文章热度:</label>
                    <input type="number" class="form-control w-25" id="hit" name="article_hit" value="0">
                </div>
                <div class="form-group relative">
                    <label>文章封面:</label>
                    <input type="file" name="article_image" class="form-control file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="showPreview(this,'.preview-add')">
                    <div class="file-box">
                        <div>
                            <i data-feather="plus"></i>
                            <img src=" "  alt="" class="preview preview-add">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>文章内容:</label>
                    <br>
                    <div class="utils mb-1">
                        <i data-feather="image" class="info add-image"></i>
                    </div>
                    <div style="display: flex">
                        <textarea id="text-input" class="w-50 mr-2" style="padding: 5px;" oninput="this.editor.update()" rows="20" cols="60" name="article_content"></textarea>
                        <div id="preview" class="w-50 markdown-preview" style="border: 1px solid #232323;padding: 5px;"> </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
            </form>
        </div>
        <!-- 文章列表 -->
        <div class="tab-pane fade {{ !session("show_list") && !$update_data ? "show active" : "" }}" id="user-list" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">文章标题</th>
                    <th scope="col">文章作者</th>
                    <th scope="col">文章栏目</th>
                    <th scope="col">文章热度</th>
                    <th scope="col">写作时间</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{$article->id}}</td>
                    <td>{{$article->article_title}}</td>
                    <td>{{$article->article_author}}</td>
                    <td>{{$article->hasSection['section_name']}}</td>
                    <td>{{$article->article_hit}}</td>
                    <td>{{$article->created_at}}</td>
                    <td>
                        <a href="{{route("article.show",['article' => $article->id])}}"><i data-feather="edit" class="info-size"></i></a>
                        <a href="{{route("article.destroy",['article' => $article->id])}}" data-method="delete" data-token="{{@csrf_token()}}" data-confirm="Confirm delete article!"><i data-feather="delete" class="info-size"></i></a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            {{$articles->links()}}
        </div>
        <!-- 文章修改 -->
        @if($update_data)
        <div class="tab-pane fade show active" id="user-edit" role="tabpanel" aria-labelledby="edit-tab">
            <form class="mt-3" method="post" action="{{route("article.update",["article" => $update_data->id])}}" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="edit-article-name">文章标题:</label>
                    <input type="text" class="form-control w-50" id="edit-article-name" name="article_title" value="{{$update_data->article_title}}">
                </div>
                <div class="form-group">
                    <label for="edit-author">文章作者:</label>
                    <input type="text" class="form-control w-50" id="edit-author" name="article_author" value="{{$update_data->article_author}}">
                </div>
                <div class="form-group">
                    <label for="edit-section-id">文章栏目:</label>
                    <select class="form-control form-control-sm w-25" id="edit-section-id" name="section_id">
                        @foreach($sections as $section)
                            <option {{$update_data->section_id == $section->id ? "selected" : ""}} value="{{$section->id}}">{{$section->section_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit-hit">文章热度:</label>
                    <input type="number" class="form-control w-25" id="edit-hit" name="article_hit" value="{{$update_data->article_hit}}">
                </div>
                <div class="form-group relative">
                    <label>文章封面:</label>
                    <input type="file" name="article_image" class="form-control file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="showPreview(this,'.preview-edit')">
                    <div class="file-box">
                        <div>
                            <i data-feather="plus"></i>
                            <img src="{{asset($update_data->article_image)}}"  alt="" class="preview preview-edit">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>文章内容:</label>
                    <div class="unit">
                        <i data-feather="image" class="info"></i>
                    </div>
                    <br>
                    <div style="display: flex">
                        <textarea id="edit-input" class="w-50 mr-2" style="padding: 5px;" oninput="this.editor.update()" rows="20" cols="60" name="article_content">{{$update_data->article_content}}</textarea>
                        <div id="preview-edit" class="w-50 markdown-preview" style="border: 1px solid #232323;padding: 5px;"> </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
            </form>
        </div>
        @endif
    </div>

@stop

@section("script")
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        EditorInit("#text-input","#preview");
        @if($update_data)
        EditorInit("#edit-input","#preview-edit");
        @endif


        document.querySelector("#text-input").addEventListener("paste",function (e) {

            if ( !(e.clipboardData && e.clipboardData.items) ) {
                return false;
            }

            console.log(this)

            const { items } = e.clipboardData

            if (items) {
                ;[...items].forEach((item) => {
                    if (item.type.indexOf('image') !== -1) {
                        let file = item.getAsFile();
                        let formData = new FormData();
                        formData.append("image",file);
                        fetch("{{route("upload")}}",{
                            method:"POST",
                            body:formData
                        }).then(res => res.json())
                        .then(res =>{
                            let host = "{{asset("/")}}"
                            this.value += `![image](${host}${res.file_path})`
                        })
                    }
                })
            }

        })





    </script>
@stop

