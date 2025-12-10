@extends('layouts.app')
@section('content')
    @include('includes.navbar')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3  sticky-top">
                <div class="border rounded p-3 text-center">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profilna slika</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        <button id="savePhotoBtn" class="btn btn-primary mt-2 w-100" style="display:none;">Sačuvaj</button>
                    </div>
                    <div class="bg-light rounded mb-3" style="height:180px; overflow:hidden;">
                        <img id="profilePreview"
                             src="{{ auth()->user()->photo ? asset('storage/profile_photos/' . auth()->user()->photo) : 'https://via.placeholder.com/180'}}"
                             class="img-fluid"
                             style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                    <h5>Dobrodošli <i>{{ $user->name }}</i></h5>
                    <p>Email: {{ $user->email }}</p>
                    <p>Broj vasih oglasa: {{$user->properties()->count()}}</p>
                </div>
                {{--                popuni necim--}}
            </div>
            <div class="col-md-6 " style="overflow-y:auto; max-height:80vh;">
                <div class="p-3 bg-white border rounded">
                    <h4>Glavni sadržaj</h4>
                    <p>Ovde ide sve ostalo...</p>
                </div>
                @if($user->properties->count() == 0)
                    <div class="alert alert-danger">
                        Nažalost nemate nijedan oglas, započnite novu avanturu što pre!
                    </div>
                @else
                    <div class="d-flex flex-column gap-4">
                        @foreach($user->properties as $prop)
                            <div class="card property-card p-3">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $prop->title }}</h5>
                                    <p class="card-text">{{ $prop->description }}</p>
                                    <p class="card-text"><strong>Cena:</strong> {{ $prop->price }} €</p>
                                    <a href="" class="btn btn-primary mt-auto">Vidi oglas</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-3 ">
                <div class="list-group">
                    <a href="{{ route('property.index') }}" class="list-group-item">Dodaj oglas</a>
                    <a href="{{ route('profile',auth()->user()->id) }}" class="list-group-item">Moji oglasi</a>
                    <div class="dropdown">
                        <button class="list-group-item dropdown-toggle w-100 text-start"
                                data-bs-toggle="dropdown">
                            Podešavanja
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" href="#" onclick="showForm('name')">Promeni ime</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showForm('email')">Promeni email</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showForm('password')">Promeni lozinku</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showForm('verify')">Verifikuj email</a></li>
                        </ul>
                    </div>
                </div>
                <div id="settingsForm" class="mt-3" style="display:none;">
                    <div class="border rounded p-3">
                        <h5 id="formTitle"></h5>
                        <input class="form-control mb-2" id="newValue" placeholder="Unesite novu vrednost">
                        <button class="btn btn-primary w-100">Sačuvaj</button>
                    </div>
                </div>
{{--                popuni necim--}}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function showForm(type) {
            document.getElementById('settingsForm').style.display = 'block';
            let title = "";
            if (type === 'name') title = "Promeni ime";
            if (type === 'email') title = "Promeni email";
            if (type === 'password') title = "Promeni lozinku";
            if (type === 'verify') title = "Verifikuj email";
            //if(title==="Promeni lozinku") da se doda +1 placeholder
            document.getElementById('formTitle').innerText = title;
        }
    </script>
@endpush
@push('scripts')
    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
        document.getElementById('savePhotoBtn').style.display = 'block';
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onload = function(event) {
        document.getElementById('profilePreview').src = event.target.result;
        }
        reader.readAsDataURL(file);
        });
        document.getElementById('savePhotoBtn').addEventListener('click', function () {
        let fileInput = document.getElementById('photo');
        if (!fileInput.files.length) return;
        let formData = new FormData();
        formData.append('photo', fileInput.files[0]);
        fetch("{{ route('profile.upload.photo') }}", {
        method: 'POST',
        headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
        })
        .then(r => r.json())
        .then(data => {
        if (data.success) {
        alert("Slika uspešno sačuvana!");
        document.getElementById('savePhotoBtn').style.display = 'none';
        }
        });
        });
    </script>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.property-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('show');
                }, index * 250);
            });
        });
    </script>
@endpush
<style>
    .property-card {
        transform: rotateX(-15deg);
        opacity: 0;
        transition: transform 0.5s ease, box-shadow 0.3s ease, transform 0.3s ease;
        cursor: pointer;
    }
    .property-card.show {
        transform: rotateX(0deg);
        opacity: 1;
    }
    .property-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }
</style>


