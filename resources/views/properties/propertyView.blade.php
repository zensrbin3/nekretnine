@extends('layouts.app')

@section('content')
    @include('includes.navbar')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="bg-primary text-white p-4 text-center animate__animated animate__fadeInDown">
                        <h1 class="fw-bold mb-1">{{ $property->title }}</h1>
                        <p class="mb-0">{{ $property->location }}</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                            <h2 class="fw-bold text-success">
                                €{{ number_format($property->price, 2, ',', '.') }}
                            </h2>
                        </div>
                        <div class="row text-center mb-4">
                            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
                                <div class="p-3 border rounded-3 h-100">
                                    <h6 class="text-muted">Tip</h6>
                                    <strong>{{ ucfirst($property->type) }}</strong>
                                </div>
                            </div>

                            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-3s">
                                <div class="p-3 border rounded-3 h-100">
                                    <h6 class="text-muted">Kvadratura</h6>
                                    <strong>{{ $property->size_m2 }} m²</strong>
                                </div>
                            </div>

                            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-4s">
                                <div class="p-3 border rounded-3 h-100">
                                    <h6 class="text-muted">Status</h6>
                                    <span class="badge bg-{{ $property->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                                </div>
                            </div>
                        </div>
                        @if($property->description)
                            <div class="animate__animated animate__fadeInUp animate__delay-5s">
                                <h5 class="fw-bold mb-2">Opis nekretnine</h5>
                                <p class="text-muted">{{ $property->description }}</p>
                            </div>
                            <div class="animate__animated animate__fadeInUp animate__delay-5s">
                                <a href="tel:{{ $property->user->phone }}" class="btn btn-success">
                                    <i class="bi bi-telephone"></i> Pozovi
                                </a>
                            </div>
                        @endif
                        @if($property->images->count())
                            <div class="slider">
                                <button id="prev"><</button>
                                <img id="sliderImage" src="{{ asset('storage/' . $property->images->first()->path) }}" alt="Nekretnina" class="img-fluid mb-2 slider-img">
                                <button id="next">></button>
                            </div>
                        @else
                            <div class="alert alert-danger">Nazalost vlasnik nekretnine nije dodao slike(iz nekog svog razloga :))</div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .slider {
        position: relative;
        max-width: 700px;
        margin: auto;
    }
    .slider-img {
        width: 100%;
        border-radius: 12px;
    }
    .slider button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,.6);
        color: white;
        border: none;
        font-size: 2rem;
        padding: 5px 15px;
        cursor: pointer;
    }
    #prev { left: 10px; }
    #next { right: 10px; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentIndex = 0;
        const images = @json($property->images->pluck('path')->map(fn($p) => asset('storage/'.$p)));
        let image = document.getElementById("sliderImage");
        document.getElementById("prev").addEventListener("click",() => {
            currentIndex=(currentIndex-1+images.length)%images.length;
            image.src=images[currentIndex];
        });
        document.getElementById("next").addEventListener("click",() => {
            currentIndex=(currentIndex+1)%images.length;
            image.src=images[currentIndex];
        });
    });
</script>
