@extends('layout.layout')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        @include('components.statusAlert')
        <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold flex-grow-1 " style="margin-top:5px">
              修改屬性名稱
            </h5>
            <button type="button" class="btn ml-auto btn-danger font-weight-bold" data-toggle="modal" data-target="#destroyModal">
              <span class="text-white">
                刪除本屬性
              </span>
            </button>
            @include('components.destroyModal',[
              'title' => '刪除本屬性',
              'message' => '屬性:'. $attribute->name . '<br>本屬性下條文將會一併刪除',
              'target' => "/attribute/". $attribute->id,
            ])
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('attribute.update', $attribute->id) }}">
              <input name="_method" type="hidden" value="PATCH">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">屬性名稱</label>
                <input id="name" type="text" name="name" class="form-control" required value="{{ $attribute->name }}">
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