@extends('template.main')

@section('content')
    <div class="row">
        <div class="col-lg-5 kiri px-0" id="kiri" style="height: 150vh">
            {{-- <img src="/img/bg-image.jpg" alt="" id="gambar" > --}}
        </div>

        <div class="col-lg " style="height: 150vh">
            <form class="d-flex flex-column justify-content-center px-4" style="height: 150vh" action="{{ route('registers') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <h3 class="mb-5 fw-bold">Create an Account</h3>

                <div class="mb-3 form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" style="width: 60%" required placeholder="example name" value="{{ old('name') }}">
                    <label for="name" class="form-label">Full Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input mb-3 form-floating">
                    <input type="text" class="form-control @if(session()->has('error')) is-invalid @endif" id="datingCode" name="datingCode" style="width: 60%" required placeholder="001" value="{{ old('datingCode') }}">
                    <label for="datingCode" class="form-label">Dating Code (3 digit ex: 002)</label>
                    @if(session()->has('error'))
                        <div class="invalid-feedback">{{ session('error') }}</div>
                    @endif
                </div>

                <div class="mb-3 form-floating">
                    <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate" style="width: 60%" required placeholder="DT001" value="{{ old('birthDate') }}">
                    <label for="birthDate" class="form-label">Birth Date</label>
                    @error('birthDate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="form-floating">
                    <select class="form-select mb-3 @error('gender') is-invalid @enderror" name="gender" aria-label="Default select example" style="width: 60%" required>
                        <option disabled selected>Select Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                    <label for="gender" class="form-label">Gender</label>
                </div>

                <div class="mb-3 form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" style="width: 60%" required placeholder="example@email.com" value="{{ old('email') }}">
                    <label for="email" class="form-label">Email</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-floating">
                    <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" name="phoneNumber" style="width: 60%" required placeholder="08xxxxxxxxxx" value="{{ old('phoneNumber') }}">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    @error('phoneNumber')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-floating">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" style="width: 60%" required>
                    <label for="email" class="form-label" id="passwordLabel">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  
                

                <div class="mb-3 form-floating">
                    <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" style="width: 60%" required>
                    <label for="photo" class="form-label">Upload Photo</label>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                

                
                <button type="submit" class="btn btn-primary" style="width: 60%">Submit</button>

                <small class="mt-3 text-center" style="width: 60%">
                    Already an account ? <a href="{{ route('login') }}">Sign In</a>
                </small>
            </form>

            
            
                
        </div>
    </div>
@endsection

<style>
    *{
        max-width: 100% ;
    }
    #aming{
        display: none;
    }

    #kiri{
        background-image: url('/img/bg-image.jpg');
        background-size: 110vh;
    }
    
</style>


