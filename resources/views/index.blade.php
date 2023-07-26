@extends('template.main')

@section('css')
    {{-- <script src="/js/filter.js"></script> --}}
@endsection

<img src="/img/background.jpg" class="img-fluid back" alt="">
@section('content')


    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible d-flex justify-content-center col-lg" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible d-flex justify-content-center col-lg" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        <div class="title d-flex justify-content-center align-items-center col-lg-12" style="height: 80vh">
            <p class="fw-bold text-white text-center">@lang('wedding.home.header')</p>
        </div>

        <div class="location col-lg bg-white mb-5 d-flex flex-row justify-content-center align-items-center px-5">
            <div class="col-lg-4">
                <div class="col-lg-12">
                    <label for="daerah" class="fw-bold mb-2 ms-1" style="color: #e7c790">@lang('wedding.home.filter')</label>
                    <select id="daerah" name="daerah" class="form-select" aria-label="Default select example">
                        <option selected disabled>@lang('wedding.home.location')</option>
                        <option value="1">Tangerang</option>
                        <option value="2">Singapore</option>
                        <option value="3">Jakarta</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                <label for="search" class="fw-bold mb-2 ms-1" style="color: #e7c790">@lang('wedding.home.search')</label>
                <div class="input-group">
                    <span class="input-group-text fw-bold" id="addon-wrapping"><i class="bi bi-search" style="-webkit-text-stroke: 1px;"></i></span>
                    <input type="text" aria-label="First name" class="form-control" placeholder="St. Regis Kuta">
                </div>
            </div>
        </div>

        <h3 class="filter-title fw-bold mb-4">@lang('wedding.home.subtitle') </h3>
        <div id="filter">
            @foreach ($venues as $venue)
            {{-- @dd($venue->regency) --}}
                <div class="wedding-option mb-4">
                    <div class="venue col-lg-12 p-3 d-flex flex-row">
                        <img src="https://source.unsplash.com/450x250/?{{ $venue->regency->name }}" alt="/img/back.jpg" class="img-fluid venue-img">
                        <div class="description ms-4 d-flex flex-column col-lg-4">
                            <h3 class="fw-bold">{{ $venue->name }}</h3>
                            <p>{{ $venue->description }}</p>
                            <div class="venue-loc d-flex ">
                                <i class="bi bi-geo-alt-fill mt-1" style="color: #e7c790"></i>
                                <p class="ms-2">Jl. {{ $venue->location }}, {{ $venue->regency->name }}</p>
                            </div>
    
                            <div class="venue-loc d-flex ">
                                {{-- <i class="bi bi-piggy-bank-fill mt-1" style="color: #e7c790"></i> --}}
                                <p class="fw-bold ms-1" style="color: #e7c790">$</p>
                                <p class="ms-2">{{ $venue->price }}</p>
                            </div>
    
                        </div>
                        <div class="btn-aja d-flex align-items-end justify-content-end col-lg me-3">
                            <a href="/book/{{ $venue->id }}" type="button" class="fw-bold book-btn btn">@lang('wedding.home.button')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        

        <div class="div" style="min-height: 100px"></div>

    </div>





    <style>
        .back{
            position: absolute;
            height: 100vh;
            width: 100%;
            /* z-index: -1 */
        }

        .aming{
            position: relative;
        }

        .title{
            font-size: 3rem;
            position: relative;
        }
        
        .location{
            border: solid 3px #cb9334;
            position: relative;
            margin-top: 20px;
            min-height: 20%;
            width: 100%;
            border-radius: 10px;
        }

        .venue{
            border: solid 2px #cb9334;
            border-radius: 10px
        }

        .venue-img{
            max-width: 25vw;
            /* border-start-end-radius: 25px; */
            /* border-end-end-radius: 25px; */
            border-radius: 15px;
            /* min-width: 10px; */
        }

        .book-btn{
            min-width: 15vw;
            min-height: 3vw;
            border: solid 3px #e7c790
        }

        .book-btn:hover{
            background-color: #cb9334;
            color: white;
        }
        
    </style>

    <script src="/js/filter.js"></script>
@endsection
