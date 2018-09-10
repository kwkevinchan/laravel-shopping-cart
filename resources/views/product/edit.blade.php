@extends('layout.layout')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        @include('components.statusAlert')
        <div class="card">
          <h5 class="card-header bg-primary text-white">修改委託單位</h5>
          <div class="card-body">
            <form method="POST" action="{{ route('company.update', $company->id) }}">
              <input name="_method" type="hidden" value="PATCH">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">委託單位名稱</label>
                <input id="name" type="text" name="name" class="form-control" required value="{{ $company->name }}">
              </div>
              <div class="form-group text-right">
                <button class="btn btn-success">存檔</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
