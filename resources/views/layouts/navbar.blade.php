<nav class="aming navbar navbar-expand-lg px-5 text-white" id="aming">
    <div class="container-fluid">
      <a class="navbar-brand py-2 px-4 text-white fw-bold fs-6" href="/" style="background-color: #964b00; border-radius: 10px; border">Nikah Ah</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active text-white" aria-current="page" href="/">@lang('wedding.navbar.home')</a>
          <a class="nav-link text-white" href="/bookings">@lang('wedding.navbar.booking')</a>
        </div>
      </div>
    </div>
    <ul class="navbar-nav ms-auto">
      {{-- jika sudah login --}}
      @auth
        {{-- @dd(session()->get('locale')) --}}
        <li class="nav-item dropdown d-flex">
          <div class="form-check form-switch text-white nav-link text-white me-3 px-3">
            <label class="form-check-label" for="flexSwitchCheckDefault">id</label>
            <input class="form-check-input" id="switch-lang" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="switchLang(@if (session()->get('locale') == 'id') 'en' @else 'id' @endif)" {{ (session()->get('locale') == 'id') ? 'checked' : ''}}>
          </div>
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome, {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if (Auth::user()->is_admin == 1)
            <li>
              <a class="dropdown-item d-flex" href="/admin">
                <i class="bi bi-grid-fill mt-1 me-2"></i>
                {{-- <i class="bi bi-layout-text-sidebar-reverse mt-1 me-2"></i> --}}
                <span>Dashboard</span>
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            @endif
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item d-flex">
                  <i class="bi bi-box-arrow-right mt-1 me-2"></i>
                  <span>Logout</span>
                </button>
              </form>
            </li>
          </ul>
        </li>

      {{-- jika belum login --}}
      @else
        
          <a class="nav-item d-flex flex-row nav-link" href="{{ route('login') }}">
            <i class="bi bi-box-arrow-in-right mt-1 text-white"></i>
            <span class="ms-2 text-white">Login</span>
          </a>
        
      @endauth

    </ul>
</nav>

<script >
  const switchLang = (lang)=>{
    console.log(lang)
    const tex = $('#switch-lang').is(':checked')
    if(tex){
      window.location.href = `/locale/${lang}`
    }else{
      window.location.href = `/locale/${lang}`
    }
  }
</script>




{{-- style="background-color: #cb9334" --}}

