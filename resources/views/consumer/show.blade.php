@extends('layouts.app')

@section('content')
<div>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        @include('components.statusAlert')
        <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold" style="margin-top:5px">
              {{ $product->name }}
            </h5>
            <a href="{{ route('consumer.index') }}" class="btn ml-auto text-white btn-success font-weight-bold" role="button" aria-pressed="true">回列表</a>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">商品類型:
                @foreach($product->productclass_id as $productclass_id)
                  @if(isset($product_class[$productclass_id]))
                    {{ $product_class[$productclass_id]->name }}
                  @endif
                @endforeach
              </li>
              <li class="list-group-item">價格:{{ $product->price }}</li>

              @if($product->volume != 0)
                <li class="list-group-item">存貨:{{ $product->volume }}</li>
              @else
                <li class="list-group-item text-danger">存貨:{{ $product->volume }}，此商品已售完!!!</li>
              @endif

              <li class="list-group-item">上架日期:{{ $product->updated_at }}</li>
              <li class="list-group-item">店家:{{ $product->user->name }}</li>

              @if($product->volume != 0)
              <li class="list-group-item">
                <form class="form-inline d-flex" action="{{ route('consumer.create') }}" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="id" value="{{ $product->id }}">
                  <div class="form-group flex-grow-1">
                    <label for="volume">購買數量</label>
                    <input class="form-control" type="number" id="volume" name="volume" value="1" min="1" max="{{ $product->volume }}">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">加入購物車</button>
                  </div>
                </form>
              </li>
              @endif
              
            </ul>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection