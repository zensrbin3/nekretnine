@extends('layouts.app')
@section('content')
    @include('includes.navbar')
    @if(session('success'))
        <div id="successAlert" class="alert alert-success text-center rounded-0 m-0 py-3">
            {{ session('success') }}
        </div>
    @endif
    @if(request()->has('success'))
        <div class="alert alert-success">{{ request('success') }}</div>
    @endif
    @if(request()->has('error'))
        <div class="alert alert-danger">{{ request('error') }}</div>
    @endif
        <div class="jumbotron text-center py-5 bg-primary text-white rounded mb-5">
            <h1 class="display-4 animate__animated animate__fadeInDown">Pronađite svoj dom iz snova</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Brza pretraga nekretnina u vašem gradu</p>
            @livewire('search-users')
        </div>
        <div class="container mb-5">
            <h2 class="mb-4">Popularne nekretnine</h2>
            <div class="row g-4">
                @foreach(\App\Models\Property::all() as $property)
                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm border-0 hover-scale">
                            <img src="" class="card-img-top" alt="Nekretnina">
                            <div class="card-body">
                                <h5 class="card-title">{{$property->title}}</h5>
                                <p class="card-text">{{$property->description}}</p>
                                <p class="card-text">{{$property->location}}</p>
                                <a href="{{route('property.show',$property->id)}}" class="btn btn-primary">Pogledaj</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @include('pricing.pricing')
    @include('includes.footer')
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alertBox = document.getElementById("successAlert");
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.transition = "opacity 0.7s ease";
                    alertBox.style.opacity = "0";

                    setTimeout(() => alertBox.remove(), 700);
                }, 2000);
            }
        });
    </script>
@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
