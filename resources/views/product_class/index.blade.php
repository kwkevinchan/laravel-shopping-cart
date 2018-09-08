@extends('layouts.app')

@section('content')
<div>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        @include('components.statusAlert')
        <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold" style="margin-top:5px">
              商品類型
            </h5>
            <a href="{{ route('productClass.create') }}" class="btn ml-auto text-white btn-success font-weight-bold" role="button" aria-pressed="true">新增類型</a>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>類型名稱</th>
                  <th>類型敘述</th>
                  <th width="20%">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product_class as $p_c)
                <tr>
                  <td>{{ $p_c->name }}</td>
                  <td>{{ $p_c->detail }}</td>
                  <td><a  class="btn btn-primary" role="button" href="{{ route('productClass.edit', $p_c->id) }}">修改</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection