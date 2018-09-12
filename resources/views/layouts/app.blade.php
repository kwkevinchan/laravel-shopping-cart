<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <title>購物車系統</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-primary">
  <a class="navbar-brand" style="color:#fff;" href="/">購物車系統</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse navbarNav d-flex">
  @auth
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">首頁</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="adminDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          管理者
        </a>
        <div class="dropdown-menu" aria-labelledby="adminDropMenu">
          <a class="dropdown-item" href="{{ route('productClass.index') }}">商品類型</a>
          <a class="dropdown-item" href="{{ route('user.index') }}">使用者管理</a>
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="storeDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          店家
        </a>
        <div class="dropdown-menu" aria-labelledby="storeDropMenu">
          <a class="dropdown-item" href="{{ route('product.index') }}">商品</a>
          <a class="dropdown-item" href="">出貨單</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="consumerDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          消費者
        </a>
        <div class="dropdown-menu" aria-labelledby="consumerDropMenu">
          <a class="dropdown-item" href="{{ route('consumer.index') }}">商品</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="statisticDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          統計
        </a>
        <div class="dropdown-menu" aria-labelledby="statisticDropMenu">
        </div>
      </li>
    </ul>
  @endauth
  </div>

  <div class="flex-row-reverse collapse navbar-collapse navbarNav">
    <ul class="navbar-nav">
    @auth
      <li class="nav-item dropdown dropleft">
        <a class="nav-link dropdown-toggle mr-sm-2" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret">歡迎，{{ Auth::user()->name }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="">個人資料修改</a>
          <a class="dropdown-item" href="{{ route('logout') }}">登出</a>
        </div>
      </li>
    @endauth
    @guest
      <li class="nav-item">
        <a class="nav-link" href="/login">登入</a>
      </li>
    @endguest
    </ul>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-12">
      @yield('content')
    </div>
  </div>
</div>


<script src="{{asset('js/app.js')}}"></script>
<!-- 導入javascipt -->
@yield('script')


</body>
</html>