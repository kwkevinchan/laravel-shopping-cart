@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            @include('components.statusAlert')
            <div class="card">
                <div class="card-header bg-primary text-white">新增使用者</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">姓名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">使用者身分</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role" id="role">
                                    <option value="">一般使用者</option>
                                @foreach($role as $r)
                                    <option value="{{ $r['name'] }}">{{ $r['name'] }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    新增使用者
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