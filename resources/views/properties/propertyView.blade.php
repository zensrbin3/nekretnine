@extends('layouts.app')

@section('content')
    @include('includes.navbar')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
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
                        @can('delete-property', $property)
                            <div class="text-center animate__animated animate__fadeInUp animate__delay-1s">
                                <form action="{{ route('property.destroy', $property->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Da li ste sigurni?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Obriši nekretninu
                                    </button>
                                </form>
                            </div>
                        @endcan
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
                            <div class="slider animate__animated animate__fadeInUp animate__delay-6s">
                                <button id="prev"><</button>
                                <img id="sliderImage" src="{{ asset('storage/' . $property->images->first()->path) }}" alt="Nekretnina" class="img-fluid mb-2 slider-img">
                                <button id="next">></button>
                            </div>
                        @else
                            <div class="alert alert-danger">Nazalost vlasnik nekretnine nije dodao slike(iz nekog svog razloga :))</div>
                        @endif
                        @if($property->comments->count())
                            <div class="mt-4 animate__animated animate__fadeInUp animate__delay-1s">
                                <h5 class="fw-bold mb-3">Komentari</h5>

                                @foreach($property->comments as $comment)
                                    <div class="d-flex mb-3">
                                        <div class="me-3">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                 style="width:40px;height:40px;">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>

                                        <div class="bg-light rounded-3 p-3 w-100">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong>{{ $comment->user->name ?? 'Gost' }}</strong>
                                                <small class="text-muted">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                            <p class="mb-0">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>

                                        <div class="d-flex gap-3 mt-2">
                                            <button class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-hand-thumbs-up"></i> Like
                                            </button>

                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-hand-thumbs-down"></i> Dislike
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif


                        <form action="{{ route('comment.store', $property->id) }}" method="POST">
                            @csrf

                            <div class="comment-wrapper animate__animated animate__fadeInUp animate__delay-5s">

                                <button type="button"
                                        id="toggleComment"
                                        class="btn btn-outline-primary d-flex align-items-center gap-2">
                                    <i class="bi bi-plus-circle"></i>
                                    Dodaj komentar
                                </button>

                                <div id="commentBox" class="comment-box mt-3">
                                <textarea class="form-control mb-2"
                                          rows="4"
                                          name="comment"
                                          placeholder="Unesite vaš komentar..."></textarea>
                                    <button type="submit" class="btn btn-primary w-100">
                                        Pošalji komentar
                                    </button>
                                </div>

                            </div>
                        </form>


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
    .comment-box {
        display: none;
        animation: fadeSlide 0.4s ease forwards;
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #toggleComment i {
        font-size: 1.2rem;
    }
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
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toggleBtn = document.getElementById('toggleComment');
        const commentBox = document.getElementById('commentBox');
        let opened = false;

        toggleBtn.addEventListener('click', function () {
            opened = !opened;

            if (opened) {
                commentBox.style.display = 'block';
                toggleBtn.innerHTML = '<i class="bi bi-dash-circle"></i> Zatvori';
            } else {
                commentBox.style.display = 'none';
                toggleBtn.innerHTML = '<i class="bi bi-plus-circle"></i> Dodaj komentar';
            }
        });

    });
</script>

