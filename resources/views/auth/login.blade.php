@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-6">
      @include('components.statusAlert')
      <div class="card">
        <div class="card-header bg-primary text-white d-flex">
          <span class="flex-grow-1">
            使用者登入
          </span>
          <a class="text-white" href="{{ route('register') }}">
            註冊
          </a>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name">帳號</label>
              <input id="name" type="text" class="form-control" name="name" required autofocus>
            </div>
            <div class="form-group">
              <label for="password">密碼</label>
              <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
              <div class="d-flex">
                <label class="flex-grow-1" style="margin-top:10px">
                  <input type="checkbox" name="remember">記住我
                </label>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                  找回密碼
                </a>

                <button type="submit" class="btn btn-primary">
                  登入
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
