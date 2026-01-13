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
                        @endif
                        @if($property->images->count())
                            <div id="slider">
                                @foreach($property->images as $image)
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="Nekretnina" class="img-fluid mb-2">
                                @endforeach
                            </div>
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
