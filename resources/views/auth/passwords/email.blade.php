@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex">
                    <span class="flex-grow-1">
                        找回密碼
                    </span>
                    <a href="/login" class="text-white">回前頁</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="control-label">請輸入註冊時所用Email</label>
                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" name="email" value="" autofocus required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    送出找回信件
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
