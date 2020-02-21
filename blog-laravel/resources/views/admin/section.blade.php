@extends("admin.layouts.app")

@section("content")
    <div class="border-bottom">
        <h3 class="h3">栏目管理</h3>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ !session("show_list") && !$update_data ? "active" : "" }}" id="home-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="true">栏目添加</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ session("show_list") && !$update_data ? "active" : "" }}" id="profile-tab" data-toggle="tab" href="#list" role="tab" aria-controls="profile" aria-selected="false">栏目列表</a>
        </li>
        @if($update_data)
        <li class="nav-item">
            <a class="nav-link active" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="true">栏目修改</a>
        </li>
            @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- 栏目添加 -->
        <div class="tab-pane fade {{ !session("show_list") && !$update_data ? "show active" : "" }}" id="add" role="tabpanel" aria-labelledby="add-tab">
            <form class="mt-3" method="post" action="{{route("section.store")}}">
                @csrf
                <div class="form-group">
                    <label for="section-name">栏目名称:</label>
                    <input type="text" class="form-control w-50" id="section-name" name="section_name">
                </div>
                <div class="form-group">
                    <label for="section-url">栏目地址:</label>
                    <input type="text" class="form-control w-50" id="section-url" name="section_url">
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
            </form>
        </div>
        <!-- 栏目列表 -->
        <div class="tab-pane fade {{ session("show_list") && !$update_data ? "show active" : "" }}" id="list" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">栏目名称</th>
                    <th scope="col">栏目地址</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sections as $section)
                <tr>
                    <td>{{$section->id}}</td>
                    <td>{{$section->section_name}}</td>
                    <td>{{$section->section_url}}</td>
                    <td>
                        <a href="{{route("section.show",['section' => $section->id])}}"><i data-feather="edit" class="info-size"></i></a>
                        <a href="{{route("section.destroy",['section' => $section->id])}}" data-method="delete" data-token="{{@csrf_token()}}" data-confirm="Confirm delete section?"><i data-feather="delete" class="info-size"></i></a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- 栏目修改 -->
        @if($update_data)
        <div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="edit-tab">
            <form class="mt-3" method="post" action="{{route("section.update",["section" => $update_data->id])}}">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="section-name">栏目名称:</label>
                    <input type="text" class="form-control w-50" id="section-name" name="section_name" value="{{$update_data->section_name}}">
                </div>
                <div class="form-group">
                    <label for="section-url">栏目地址:</label>
                    <input type="text" class="form-control w-50" id="section-url" name="section_url" value="{{$update_data->section_url}}">
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">修改</button>
                </div>
            </form>
        </div>
        @endif

    </div>
@stop

