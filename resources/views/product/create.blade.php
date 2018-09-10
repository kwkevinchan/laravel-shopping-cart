@extends('layout.layout')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        @include('components.statusAlert')
        <div class="card">
          <h5 class="card-header bg-primary text-white">新增委託單位</h5>
          <div class="card-body">
            <form method="POST" action="{{ route('company.store') }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">委託單位名稱</label>
                <input id="name" type="text" name="name" class="form-control" required>
              </div>
              <div class="form-group text-right">
                <button class="btn btn-success">新增</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
