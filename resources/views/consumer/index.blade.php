@extends('layouts.app')

@section('content')
<div>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12">
        @include('components.statusAlert')
        <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold" style="margin-top:5px">
              商品清單
            </h5>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>商品名稱</th>
                  <th width="20%">類型</th>
                  <th width="20%">價格</th>
                  <th width="20%">存貨</th>
                  <th width="20%">詳細資料</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product as $p)
                  <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->product_classes['name'] }}</td>
                    <td>{{ $p->price }}</td>
                    @if($p->volume)
                      <td>{{ $p->volume }}</td>
                    @else
                      <td class="text-danger">商品售完!!</td>
                    @endif
                    <td><a href="{{ route('consumer.show', $p->id) }}" class="btn text-white btn-primary" role="button" aria-pressed="true">商品內容</a></td>
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