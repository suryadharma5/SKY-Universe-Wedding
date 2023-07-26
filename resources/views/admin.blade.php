@extends('template.main')

@section('content')
<style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }
    .bd-mode-toggle {
      z-index: 1500;
    }

    #aming{
        display: none;
    }
  </style>

<link href="/css/dashboard.css" rel="stylesheet">

<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Nikah Ah</a>
  <span class="me-5 text-white p-1" style="border-radius: 10px;">Welcome, {{ Auth::user()->name }}</span>
</header>

<div class="container-fluid">
  <div class="row">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 text-decoration-none text-black" href="/">
                <i class="bi bi-door-open-fill"></i>
                <span class="mt-1">Back to home</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Registered Users</h1>
      </div>

      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Dating Code</th>
              <th scope="col">Dating ID</th>
              <th scope="col">Birth Date</th>
              <th scope="col">Gender</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>DT{{ $user->datingCode }}</td>
                    <td>{{ $user->dating_id }}</td>
                    <td>{{ $user->birthDate }}</td>
                    <td>@if ($user->gender == 1) <span>Male</span> @else <span>female</span> @endif</td>
                    <td>
                        <form action="/admin/ban" method="POST" class="ban-user-{{ $user->id }}">
                            @csrf
                            @if ($user->is_banned == 1)
                              <button class="btn btn-success " type="button" onclick="unbanUser({{ $user->id }})">Un-Ban</button>
                            @else
                              <button class="btn {{ $user->is_admin == 1 ? 'btn-secondary' : 'btn-danger' }} " onclick="banUser({{ $user->id }})" type="button" {{ $user->is_admin == 1 ? 'disabled' : '' }}>Ban</button>
                            @endif
                            
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>

    <script>
      const banUser = (id) => {
        Swal.fire({
          title: 'Are you sure ? ',
          text: "User {{ $user->dating_id }} will be banned from this website",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ban',
        }).then((result) => {
          if (result.isConfirmed) {
            document.querySelector('.ban-user-'+id).submit();
          }
        })
      }

      const unbanUser = (id) => {
        Swal.fire({
          title: 'Are you sure ? ',
          text: "User {{ $user->dating_id }} will be unbanned from this website",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Un-Ban',
        }).then((result) => {
          if (result.isConfirmed) {
            document.querySelector('.ban-user-'+id).submit();
          }
        })
      }
    </script>
@endsection