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
              您購物車內的商品清單
            </h5>
            @if(session()->has('id'))
              <a href="{{ route('consumer.show', session('id')) }}" class="btn ml-auto text-white btn-success font-weight-bold" role="button" aria-pressed="true">回商品</a>
            @endif
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>商品名稱</th>
                  <th width="20%">價格</th>
                  <th width="20%">加入購物車時間</th>
                  <th width="20%">移除</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cart as $p)
                  <tr>
                    @if($p->product === null)
                      <td colspan="3">對不起，您所選擇的商品已下架</td>
                      <td>
                        <a href="{{ route('consumer.remove', $p->id) }}" class="btn text-white btn-primary" role="button" aria-pressed="true">移除商品</a>
                      </td>
                    @else
                      <td>
                        <a href="{{ route('consumer.show', $p->product->id) }}" class="" aria-pressed="true">{{ $p->product->name }}</a>
                      </td>
                      <td>{{ $p->price }}</td>
                      <td>{{ $p->volume }}</td>
                      <td>
                        <a href="{{ route('consumer.remove', $p->id) }}" class="btn text-white btn-primary" role="button" aria-pressed="true">移除商品</a>
                      </td>
                    @endif
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