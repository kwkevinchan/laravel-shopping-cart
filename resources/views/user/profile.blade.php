@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-8">
      @include('components.statusAlert')
      <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold" style="margin-top:5px">
              使用者資料修改(使用者)
            </h5>
            <a href="/" class="btn ml-auto text-white btn-success font-weight-bold" role="button" aria-pressed="true">回到首頁</a>
          </div>

          <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('profile.update', $user->id) }}">
            <input name="_method" type="hidden" value="PATCH">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="name" class="col-md-4 control-label">姓名</label>
                <div class="col-md-10">
                  <input id="name" type="name" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email</label>
                <div class="col-md-10">
                  <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>
              </div>

              <div class="form-group">
                
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