<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid d-flex justify-content-between">
    <a class="navbar-brand me-auto" href="{{route('index')}}">Home</a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarToggle"
      aria-controls="navbarToggle"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mg-3" id="navbarToggle">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        @if(!session()->has('token'))
        <li class="nav-item">
          <a class="nav-link " href="{{route('login')}}" tabindex="-1" aria-disabled="true">Login</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('restaurant.create')}}">Add Restaurante</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('logout')}}" tabindex="-1" aria-disabled="true">Logout</a>
        </li>
        @endif
      </ul>
    </div>

  </div>
</nav>
