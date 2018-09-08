@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        @include('components.statusAlert')
        <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold flex-grow-1 " style="margin-top:5px">
              修改類別名稱
            </h5>
            <button type="button" class="btn ml-auto btn-danger font-weight-bold" data-toggle="modal" data-target="#destroyModal">
              <span class="text-white">
                刪除本類別
              </span>
            </button>
            @include('components.destroyModal',[
              'title' => '刪除本類別',
              'message' => '類別:'. $product_class->name,
              'target' => "/productClass/". $product_class->id,
            ])
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('productClass.update', $product_class->id) }}">
              <input name="_method" type="hidden" value="PATCH">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">類別名稱</label>
                <input id="name" type="text" name="name" class="form-control" required value="{{ $product_class->name }}">
              </div>

              <div class="form-group">
                <label for="detail">類別名稱</label>
                <input id="detail" type="text" name="detail" class="form-control" required value="{{ $product_class->detail }}">
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