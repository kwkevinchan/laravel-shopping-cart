@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        @include('components.statusAlert')
        <div class="card">
          <h5 class="card-header bg-primary text-white">新增商品</h5>
          <div class="card-body">
            <form method="POST" action="{{ route('product.store') }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">商品名稱</label>
                <input id="name" type="text" name="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="detail">商品描述</label>
                <input id="detail" type="text" name="detail" class="form-control">
              </div>

              <div class="form-group">
                <label for="product_class"  data-toggle="collapse" href="#product_calss" aria-expanded="false" aria-controls="product_calss">商品類型(點擊展開選擇)</label>

                <div class="card-body collapse" id="product_calss">
                @foreach($product_class as $row_class)
                  <div class="row">
                    @foreach($row_class as $check_class)
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="{{ $check_class->id }}" value="{{ $check_class->id }}" name="product_calss[]">
                      <label class="form-check-label" for="{{ $check_class->id }}">{{ $check_class->name }}</label>
                    </div>
                    @endforeach
                  </div>
                @endforeach
                </div>
                
              </div>

              <div class="form-group">
                <label for="price">商品定價</label>
                <input id="price" type="number" name="price" class="form-control col-2">
              </div>

              <div class="form-group">
                <label for="volume">商品數量</label>
                <input id="volume" type="number" name="volume" class="form-control col-2">
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
