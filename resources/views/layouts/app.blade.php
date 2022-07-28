<!DOCTYPE html>
<html>
<head>
    <title>E commmerce application</title>
    <script src="{{asset('js/app.js')}}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{csrf_token()}}" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">E-commerce application</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('category.list')  }}">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('product.list') }}">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('order.list') }}">Orders</a>
      </li>
           
    </ul>
  </div>
</nav>

@yield('content')


</body>
</html>