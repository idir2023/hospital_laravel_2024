<div class="collapse navbar-collapse" id="navbarSupport">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('client.home') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('client.about') }}">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('client.doctor') }}">Doctors</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('client.contact') }}">Contact</a>
      </li>
      @auth
      <li class="nav-item">
        <a class="btn btn-primary ml-lg-3" href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      @else
      <li class="nav-item">
        <a class="btn btn-primary ml-lg-3" href="{{ route('login') }}">Login / Register</a>
      </li>
      @endauth
    </ul>
  </div> <!-- .navbar-collapse -->
