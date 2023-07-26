@extends('template.main')

@section('content')
    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: 'Pembayaran Berhasil',
                text: '{{ session('success') }}',
                icon: 'success',
            });
        </script>
    @endif

    <div class="container mt-4 mb-4">
        @if ($bookings->count())
            <h3 class="mb-3 fw-bold">My Bookings</h3>
            @foreach ($bookings as $booking)
                <div class="wedding-option mb-4">
                    <div class="booking col-lg-12 p-3 d-flex flex-row">
                        <img src="https://source.unsplash.com/450x250/?{{ $booking->venue->regency->name }}" alt="/img/back.jpg" class="img-fluid booking-img">
                        <div class="description ms-4 d-flex flex-column col-lg-4">
                            <h3 class="fw-bold">{{ $booking->venue->name }}</h3>
                            <p>{{ $booking->venue->description }}</p>
                            <div class="booking-loc d-flex ">
                                <i class="bi bi-geo-alt-fill mt-1" style="color: #e7c790"></i>
                                <p class="ms-2">Jl. {{ $booking->venue->location }}, {{ $booking->venue->regency->name }}</p>
                            </div>

                            <div class="booking-loc d-flex ">
                                {{-- <i class="bi bi-piggy-bank-fill mt-1" style="color: #e7c790"></i> --}}
                                <i class="bi bi-calendar-event-fill mt-1" style="color: #e7c790"></i>
                                <p class="ms-2">{{$booking->date}}</p>
                            </div>

                        </div>
                        <div class="btn-aja d-flex align-items-end justify-content-end col-lg me-3">
                            <button type="button" class="fw-bold book-btn btn" id="book-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">View Detail</button>
                        </div>
                    </div>
                </div>

                {{--                                               Modal                                                   --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Booking Detail</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="total mt-3 p-3" style="border: #e7c790 2px solid; border-radius: 15px;">
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                        <h6 class="my-0">Venue Price</h6>
                                      </div>
                                      <span class="text-body-secondary">$  {{ $booking->venue->price }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                        <h6 class="my-0">Service Charge</h6>
                                      </div>
                                      <span class="text-body-secondary">$ {{ $booking->venue->price * 5/100 }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                        <h6 class="my-0">Tax</h6>
                                      </div>
                                      <span class="text-body-secondary">$ {{ $booking->venue->price * 10/100 }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                        <h6 class="my-0">Other</h6>
                                      </div>
                                      <span class="text-body-secondary">$ {{ $booking->venue->price * 2/100 }}</span>
                                    </li>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                      <span>Total (USD)</span>
                                      <strong>$ {{ $booking->venue->price +  $booking->venue->price * 5/100 + $booking->venue->price * 10/100 + $booking->venue->price * 2/100}}</strong>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-book d-flex flex-column justify-content-center align-items-center" style="height: 80vh">
                <h2 class="fw-bold">You Don't Have a Booking Yet 🥲</h2>
                <a type="button" class="btn btn-primary" href="/">Book Now</a>
            </div>
        @endif
    </div>

@endsection

<style>
    .booking{
        border: solid 2px #cb9334;
        border-radius: 10px
    }

    .booking-img{
        max-width: 25vw;
        /* border-start-end-radius: 25px; */
        /* border-end-end-radius: 25px; */
        border-radius: 15px;
        /* min-width: 10px; */
    }

    #aming{
        background-color: #e7c790;
    }

    #book-btn{
        min-width: 15vw;
        min-height: 3vw;
        border: solid 3px #e7c790
    }

    #book-btn:hover{
        background-color: #cb9334;
        color: white;
    }
</style>