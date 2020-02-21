@extends("admin.layouts.app")

@section("content")
    <div class="border-bottom">
        <h3 class="h3">用户管理</h3>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ !session("show_list") && !$update_data ? "active" : "" }}" id="home-tab" data-toggle="tab" href="#user-add" role="tab" aria-controls="home" aria-selected="true">用户添加</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ session("show_list") && !$update_data ? "active" : "" }}" id="profile-tab" data-toggle="tab" href="#user-list" role="tab" aria-controls="profile" aria-selected="false">用户列表</a>
        </li>
        @if($update_data)
            <li class="nav-item">
                <a class="nav-link active" id="edit-tab" data-toggle="tab" href="#user-edit" role="tab" aria-controls="edit" aria-selected="false">用户管理</a>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- 用户添加 -->
        <div class="tab-pane fade {{ !session("show_list") && !$update_data ? "show active" : "" }}" id="user-add" role="tabpanel" aria-labelledby="home-tab">
            <form class="mt-3" method="post" action="{{route("user.store")}}">
                @csrf
                <div class="form-group">
                    <label for="username">用户名称:</label>
                    <input type="text" class="form-control w-50" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="password">用户密码:</label>
                    <input type="password" class="form-control w-50" name="password" id="password">
            </div>
            <div class="form-group">
                    <label >用户身份:</label>
                    <select class="form-control form-control-sm w-50" name="type">
                        <option value="1">普通用户</option>
                        <option value="0">管理员</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mb-2">创建</button>
                </div>
            </form>
        </div>
        <!-- 用户列表 -->
        <div class="tab-pane fade {{ session("show_list") && !$update_data ? "show active" : "" }}" id="user-list" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">用户名称</th>
                    <th scope="col">用户身份</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @if($users)
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->username}}</td>
                        <td>{{$user->type == 0 ? "管理员" : "普通用户"}}</td>
                        <td>
                            <a href="{{route("user.show",["user" => $user->id])}}"><i data-feather="edit" class="info-size"></i></a>
                            <a href="{{route("user.destroy",['user' => $user->id])}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?"><i data-feather="delete" class="info-size"></i></a>
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <!-- 用户修改 -->
        @if($update_data)
        <div class="tab-pane fade show active" id="user-edit" role="tabpanel" aria-labelledby="edit-tab">
            <form class="mt-3" method="post" action="{{route("user.update",['user' => $update_data->id])}}">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="username">用户名称:</label>
                    <input type="text" class="form-control w-50" name="username" id="username" value="{{$update_data->username}}">
                </div>
                <div class="form-group">
                    <label for="password">用户密码:</label>
                    <input type="password" class="form-control w-50" name="password" id="password">
                </div>
                <div class="form-group">
                    <label >用户身份:</label>
                    <select class="form-control form-control-sm w-50" name="type">
                        <option value="1" {{$update_data->type == 1 && "selected"}}>普通用户</option>
                        <option value="0" {{$update_data->type == 0 && "selected"}}>管理员</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mb-2">修改</button>
                </div>
            </form>
        </div>
        @endif
    </div>
@stop

