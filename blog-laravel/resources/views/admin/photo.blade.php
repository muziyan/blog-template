@extends("admin.layouts.app")

@section("content")

    <div class="border-bottom">
        <h3 class="h3">图片管理</h3>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ session("show_list") && !$update_data ? "active" : "" }}" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="home" aria-selected="true">图片添加</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ !session("show_list") && !$update_data ? "active" : "" }}" id="profile-tab" data-toggle="tab" href="#user-list" role="tab" aria-controls="profile" aria-selected="false">图片列表</a>
        </li>
        @if($update_data)
            <li class="nav-item">
                <a class="nav-link active" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">图片修改</a>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- 图片添加 -->
        <div class="tab-pane fade {{ session("show_list") && !$update_data ? "show active" : "" }}" id="add" role="tabpanel" aria-labelledby="add-tab">
            <form class="mt-3" method="post" enctype="multipart/form-data" action="{{route("photo.store")}}">
                @csrf
                <div class="form-group">
                    <label for="section-name">图片名称:</label>
                    <input type="text" class="form-control w-50" id="section-name" name="photo_name">
                </div>
                <div class="from-group relative">
                    <label >上传图片:</label>
                    <input type="file" class="form-control file" name="photo_url" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="showPreview(this,'.preview-add')">
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
        <!-- 图片列表 -->
        <div class="tab-pane fade {{ !session("show_list") && !$update_data ? "show active" : "" }}" id="user-list" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">图片名称</th>
                    <th scope="col">图片地址</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td>{{$photo->photo_name}}</td>
                    <td><img src="{{asset($photo->photo_url)}}" alt="" class="img-size"></td>
                    <td>
                        <a href="{{route("photo.show",["photo" => $photo->id])}}"><i data-feather="edit" class="info-size"></i></a>
                        <a href="{{route('photo.destroy',['photo' => $photo->id])}}" data-method="delete" data-token="{{@csrf_token()}}" data-confirm="Confirm delete  this is photo?"><i data-feather="delete" class="info-size"></i></a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            {{$photos->links()}}
        </div>
        <!-- 图片修改 -->
        @if($update_data)
        <div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="edit-tab">
            <form class="mt-3" method="post" enctype="multipart/form-data" action="{{route("photo.update",['photo' => $update_data->id])}}">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="section-name">图片名称:</label>
                    <input type="text" class="form-control w-50" id="section-name" name="photo_name" value="{{$update_data->photo_name}}">
                </div>
                <div class="from-group relative">
                    <label >上传图片:</label>
                    <input type="file" name="photo_url" class="form-control file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="showPreview(this,'.preview-edit')">
                    <div class="file-box">
                        <div>
                            <i data-feather="plus"></i>
                            <img src="{{asset($update_data->photo_url)}}" alt="" class="preview preview-edit">
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
