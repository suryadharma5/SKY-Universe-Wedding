@extends('template.main')


@section('css')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="back d-flex flex-row align-items-center">
            <a href="/">
                <h2 class="back-btn bi bi-arrow-left-circle-fill" style="color: #e7c790"></h2>
            </a>
            <h4 class="ms-3 fw-bold">@lang('wedding.detail.title')</h4>
        </div>

        <h3 class="fw-bold mt-5">{{ $venue->name }}</h3>

        <div class="location d-flex align-items-center">
            <i class="bi bi-geo-alt me-2"></i>
            <small>{{ $venue->location }}, {{ $venue->regency->name }}</small>
        </div>

        <div class="col-lg d-flex flex-row">
            <img src="https://source.unsplash.com/560x325/?{{ $venue->regency->name }}" alt="/img/back.jpg" class="img-fluid venue-img mt-3">
            <div class="description ms-4 mt-4">
                <h5 class="mt-4 fw-bold">@lang('wedding.detail.about')</h5>
                <p class="col-lg-8">{{ $venue->description }}</p>
                <h5 class="mt-4 fw-bold">@lang('wedding.detail.price')</h5>
                <div class="price col-lg-2 text-center d-flex justify-content-center align-items-center pt-2">
                    <p class="fw-bold" style="color: #e7c790;"> $ {{ $venue->price }}</p>
                </div>
            </div>
            
        </div>

        <div class="wrap mt-3 col-lg-12 d-flex flex-row">
            <div class="col-lg-7">
                <h4 class="mt-3 fw-bold">@lang('wedding.detail.form')</h4>
                <form class="form mt-3 p-3" action="/book/confirm" method="POST">
                    <h5 class="mb-3">@lang('wedding.detail.contact')</h5>
                    @csrf
                    <input type="hidden" name="venue_id" value="{{ $venue->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="email-phone d-flex">
                        <div class="mb-3 col-lg-5 form-floating">
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ auth()->user()->email }}"  required>
                            <label for="email" class="form-label">@lang('wedding.detail.email')</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-5 form-floating ms-4">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ auth()->user()->name }}"  required>
                            <label for="name" class="form-label">@lang('wedding.detail.name')</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="email-phone d-flex">
                        <div class="col-lg-5">
                            <div class="input-group mb-3 form-floating col-lg" style="">
                                <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="8xxxxxxxxxx" value="{{ auth()->user()->phoneNumber }}" required>
                                <label for="phone" class="form-label">@lang('wedding.detail.phoneNumber')</label>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-lg-5 ms-4 form-floating">
                            <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" id="date" placeholder="name@example.com" required>
                            <label for="date" class="form-label">@lang('wedding.detail.date')</label>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>  
                    </div>


                    <h5 class="mb-3">@lang('wedding.detail.method')</h5>
                    <div class="email-phone d-flex">
                        <div class="mb-3 col-lg-5 form-floating">
                            <select name="payment" id="payment" class="form-select @error('payment') is-invalid @enderror" aria-label="Default select example">
                                <option selected disabled>@lang('wedding.detail.chooseBank')</option>
                                <option value="1">BCA</option>
                                <option value="2">BNI</option>
                                <option value="3">Mandiri</option>
                                <option value="4">BRI</option> 
                            </select>
                            <label for="payment" class="form-label">Virtual Account</label>
                            @error('payment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror   
                        </div>

                        <div class="mb-3 col-lg-5 form-floating ms-4">
                            <input name="virtual-num" type="text" class="form-control" id="no" placeholder="name@example.com" value="-" disabled>
                            <label for="virtual-num" class="form-label">@lang('wedding.detail.vaNumber')</label>  
                        </div> 
                        
                    </div>
                    

                    <div class="wrap d-flex justify-content-end mt-2 col-lg-11 pe-5">
                        {{-- <div class="col-lg-5"></div> --}}
                        <button type="submit" class="btn text-white fw-bold col-lg" style="background-color: #e7c790">@lang('wedding.detail.button')</button>
                        {{-- <div class="col-lg"></div> --}}
                    </div>
                </form>
            </div>
    
            <div class="col-lg-3 ms-5">
                <h4 class="mt-3 fw-bold">@lang('wedding.detail.paymentHeader')</h4>
                <div class="total mt-3 p-3" style="border: #e7c790 2px solid; border-radius: 15px;">
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                          <div>
                            <h6 class="my-0">@lang('wedding.detail.price')</h6>
                          </div>
                          <span class="text-body-secondary">$  {{ $venue->price }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                          <div>
                            <h6 class="my-0">Service Charge</h6>
                          </div>
                          <span class="text-body-secondary">$ {{ $service }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                          <div>
                            <h6 class="my-0">Tax</h6>
                          </div>
                          <span class="text-body-secondary">$ {{ $tax }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                          <div>
                            <h6 class="my-0">Other</h6>
                          </div>
                          <span class="text-body-secondary">$ {{ $other }}</span>
                        </li>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                          <span>Total (USD)</span>
                          <strong>$ {{ $total}}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="div" style="min-height: 100px"></div>
        
        
        
    </div>
    
    <script src="/js/ajax.js"></script>
@endsection

<style>
    #aming{
        display: none;
    }

    .back-btn:hover{
        cursor: pointer;
        transform: scale(1.1,1.1)
    }

    .venue-img{
       /* width: 100%; */
        border-radius: 15px;
    }

    .price{
        border: #e7c790 2px solid;
        border-radius: 8px;
    }

    .form{
        border: #e7c790 2px solid;
        border-radius: 10px;
    }

</style>
