@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-8">
      @include('components.statusAlert')
      <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold" style="margin-top:5px">
              使用者資料修改(管理員)
            </h5>
            <a href="{{ route('user.index') }}" class="btn ml-auto text-white btn-success font-weight-bold" role="button" aria-pressed="true">回到列表</a>
          </div>

          <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
            <input name="_method" type="hidden" value="PATCH">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="name" class="col-md-4 control-label">姓名</label>
                <div class="col-md-12 d-flex">
                  <input id="name" type="text" class="form-control col-6" name="name" value="{{ $user->name }}" required>
                  <button  type="button" class="btn btn-danger " style="margin-left:10px;"  data-toggle="modal" data-target="#destroyModal">刪除使用者</button>
                  @include('components.destroyModal',[
                    'title' => '刪除此使用者',
                    'message' => '使用者:'. $user->name,
                    'target' => "/user/". $user->id,
                  ])
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email</label>
                <div class="col-md-10">
                  <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>
              </div>

              <div class="form-group">
                <label for="role" class="col-md-4 control-label">選擇使用者身分</label>
                <div class="col-md-10">
                  <select class="form-control col-md-7" id="role" name="role">
                    <option value="" selected>一般使用者</option>
                    @foreach($role as $r)
                      @if($user->roles->isNotEmpty() && $r->name == $user->roles[0]->name)
                        <option value="{{ $r->name }}" selected>{{ $r->name }}</option>
                      @else
                        <option value="{{ $r->name }}">{{ $r->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>

                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                      修改
                    </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection