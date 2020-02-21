@if(session("notice"))
    <div class="alert alert-success show fade" role="alert" style="position: fixed;top:55px;left: 50%;transform: translateX(-50%);z-index: 99">
        {{session("notice")}}
    </div>
@endif

@if(session("error"))
    <div class="alert alert-danger show fade" role="alert" style="position: fixed;top:55px;left: 50%;transform: translateX(-50%);z-index: 99">
        {{session("error")}}
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger show fade" role="alert" style="position: fixed;top:55px;left: 50%;transform: translateX(-50%);z-index: 99">
            {{$error}}
        </div>
    @endforeach
@endif


