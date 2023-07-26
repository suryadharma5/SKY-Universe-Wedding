<nav class="aming navbar navbar-expand-lg px-5 text-white" id="aming" style="background-color: #cb9334">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
          <a class="nav-link text-white" href="#">Features</a>
          <a class="nav-link text-white" href="#">Pricing</a>
        </div>
      </div>
    </div>
    <ul class="navbar-nav ms-auto">
      {{-- jika sudah login --}}
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome Back, {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i>My Dashboard</a></li>
            <li><hr class="dropdown-divider"></li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item">
                <i class="bi bi-box-arrow-right"></i>Logout
              </button>
            </form>
          </ul>
        </li>

      {{-- jika belum login --}}
      @else
        
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-box-arrow-in-right mr-3"></i>Login</a>
          </li>
        
      @endauth

    </ul>
</nav>


