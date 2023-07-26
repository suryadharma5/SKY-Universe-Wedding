@extends('template.main')

@section('css')
    <link rel="stylesheet" href="login.css">
@endsection

@section('content')
    @if (session()->has('banned'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Banned',
                text: '{{ session('banned') }}',
            })
        </script>
    @endif
    <div class="row">
        <div class="col-lg-5 kiri px-0" id="kiri" style="height: 100vh">
            {{-- <img src="/img/bg-image.jpg" alt="" id="gambar" > --}}
        </div>

        <div class="col-lg " style="height: 100vh">
            <form class="d-flex flex-column justify-content-center px-4" style="height: 100vh" action="/login" method="POST">
                @csrf
                <h3 class="mb-5 fw-bold">Sign In</h3>
                <div class="mb-3 form-floating">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email / username" style="width: 60%" required autofocus>
                    <label for="id" class="form-label">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 form-floating">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" style="width: 60%" required autocomplete="off">
                    <label for="password" class="form-label">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="width: 60%">Submit</button>

                <small class="mt-3 text-center" style="width: 60%">
                    dont have an account ? <a href="{{ route('register') }}">Register</a>
                </small>
            </form>

            
            
                
        </div>
    </div>
@endsection

<style>
    *{
        max-width: 100%;
    }
    #aming{
        display: none;
    }

    #kiri{
        background-image: url('/img/bg-image.jpg');
        background-size: 100vh;
    }

    /* #gambar{
        max-height: 100px;
    } */

    
</style>


