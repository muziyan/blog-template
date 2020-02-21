@extends("admin.layouts.app")

@section("content")
    <div class="border-bottom">
        <h3 class="h3">轮播管理</h3>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ !session("show_list") && !$update_data ? "active" : "" }}" id="home-tab" data-toggle="tab" href="#user-add" role="tab" aria-controls="home" aria-selected="true">轮播添加</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ session("show_list") && !$update_data ? "active" : "" }}" id="profile-tab" data-toggle="tab" href="#user-list" role="tab" aria-controls="profile" aria-selected="false">轮播列表</a>
        </li>
        @if($update_data)
            <li class="nav-item">
                <a class="nav-link active" id="edit-tab" data-toggle="tab" href="#user-edit" role="tab" aria-controls="edit" aria-selected="false">轮播修改</a>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- 轮播添加 -->
        <div class="tab-pane fade {{ !session("show_list") && !$update_data ? "show active" : "" }}" id="user-add" role="tabpanel" aria-labelledby="home-tab">
            <form class="mt-3" method="post" action="{{route("carousel.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="carousel_name">轮播名称:</label>
                    <input type="text" class="form-control w-50" id="carousel_name" name="carousel_name">
                </div>
                <div class="from-group relative">
                    <label >上传图片:</label>
                    <input type="file" class="form-control file" name="image_url" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="showPreview(this,'.preview-add')">
                    <div class="file-box">
                        <div>
                            <i data-feather="plus"></i>
                            <img src="" alt="" class="preview preview-add">
                        </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
            </form>
        </div>
        <!-- 轮播列表 -->
        <div class="tab-pane fade {{ session("show_list") && !$update_data ? "show active" : "" }}" id="user-list" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">轮播名称</th>
                    <th scope="col">轮播图片</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carousels as $carousel)
                <tr>
                    <td>{{$carousel->id}}</td>
                    <td>{{$carousel->carousel_name}}</td>
                    <td><img src="{{asset($carousel->image_url)}}" alt="" class="img-size"></td>
                    <td>
                        <a href="{{route("carousel.show",['carousel' => $carousel->id])}}"><i data-feather="edit" class="info-size"></i></a>
                        <a href="{{route("carousel.destroy",['carousel' => $carousel->id])}}" data-token="{{@csrf_token()}}" data-method="delete" data-confirm="Confirm delete?"><i data-feather="delete" class="info-size"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- 轮播修改 -->
        @if($update_data)
        <div class="tab-pane fade show active" id="user-edit" role="tabpanel" aria-labelledby="-tab">
            <form class="mt-3" method="post" action="{{route("carousel.update",["carousel"=>$update_data->id])}}" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="carousel_name">轮播名称:</label>
                    <input type="text" class="form-control w-50" id="carousel_name" name="carousel_name" value="{{$update_data->carousel_name}}">
                </div>
                <div class="from-group relative">
                    <label >上传图片:</label>
                    <input type="file" class="form-control file" name="image_url" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="showPreview(this,'.preview-edit')">
                    <div class="file-box">
                        <div>
                            <i data-feather="plus"></i>
                            <img src="{{asset($update_data->image_url)}}" alt="" class="preview-edit preview">
                        </div>
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

