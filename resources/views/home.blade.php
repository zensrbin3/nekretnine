@extends('layouts.app')
@section('content')
    @include('includes.navbar')
    @if(session('success'))
        <div id="successAlert" class="alert alert-success text-center rounded-0 m-0 py-3">
            {{ session('success') }}
        </div>
    @endif
        <div class="jumbotron text-center py-5 bg-primary text-white rounded mb-5">
{{--            ovde--}}
            <h1 class="display-4 animate__animated animate__fadeInDown">Pronađite svoj dom iz snova</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Brza pretraga nekretnina u vašem gradu</p>
            <form class="d-flex justify-content-center mt-4">
                <input class="form-control w-50 me-2" type="search" placeholder="Pretraži nekretnine..." aria-label="Search">
                <button class="btn btn-light" type="submit">Pretraži</button>
            </form>
        </div>
        <div class="container mb-5">
            <h2 class="mb-4">Popularne nekretnine</h2>
            <div class="row g-4">
                @for($i = 0; $i < 4; $i++)
                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm border-0 hover-scale">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Nekretnina">
                            <div class="card-body">
                                <h5 class="card-title">Lepa nekretnina #{{ $i+1 }}</h5>
                                <p class="card-text">Opis nekretnine, lokacija, kvadratura...</p>
                                <a href="#" class="btn btn-primary">Pogledaj</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
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
