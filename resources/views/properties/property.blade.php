@extends('layouts.fullscreen')
@section('style')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* 🔵 LOADER */
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffff;
            z-index: 9999;
        }

        #loader-box {
            width: 130px;
            height: 130px;
            background: url('{{ asset('slike/nekretninaa.png') }}') center/cover no-repeat;
            border-radius: 12px;
            animation: spin 2s infinite linear;
        }

        @keyframes spin {
            from { transform: rotateY(0deg); }
            to { transform: rotateY(360deg); }
        }

        /* 🔵 GLOBALNA TALASASTA POZADINA PREKO CELOG EKRANA */
        .moving-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('slike/nekretninaa.png') }}') repeat-x;
            background-size: cover;

            animation: wave 18s linear infinite;

            z-index: -1;
            filter: brightness(0.55); /* da sadržaj bude vidljiv */
        }


        /* 🔵 TALASASTA ANIMACIJA */
        @keyframes wave {
            0% {
                background-position: 0 0;
            }
            50% {
                background-position: -1500px 20px;
            }
            100% {
                background-position: 0 0;
            }
        }

        /* 🔵 SADRŽAJ */
        #content {
            position: relative;
            z-index: 10;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .container {
            max-width: 650px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.92);
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 0 12px rgba(0,0,0,0.25);
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #bbb;
        }

        button {
            margin-top: 22px;
            width: 100%;
            padding: 12px;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 6px;
            font-size: 17px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div id="loader-wrapper">
        <div id="loader-box"></div>
    </div>
    <div class="moving-bg"></div>
    <form method="POST" action="{{route('property.store')}}">
        @csrf
        <div id="content" style="display:none;">
            <div class="container">
                <h2>Dodavanje Oglasa</h2>

                <label>Naslov oglasa:</label>
                <input type="text" name="title" placeholder="Unesite naslov..." />

                <label>Izaberite vrstu nekretnine:</label>
                <div>
                    <input type="radio" name="type" value="apartment"> Stan <br>
                    <input type="radio" name="type" value="house"> Kuća <br>
                    <input type="radio" name="type" value="land"> Plac <br>
                    <input type="radio" name="type" value="office"> Lokal
                </div>
                <label>Opis:</label>
                <textarea rows="5" name="description" placeholder="Unesite opis..."></textarea>
                <label>Lokacija:</label>
                <input type="text" name="location" placeholder="Unesite lokaciju..." />
                <label>Cena (€):</label>
                <input type="number" name="price" placeholder="Unesite cenu..." />
                <label>Veličina(m^2):</label>
                <input type="number" name="size_m2" placeholder="Unesite veličinu..." />
                <button>Sačuvaj oglas</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        setTimeout(() => {
            document.getElementById('loader-wrapper').style.display = 'none';
            document.getElementById('content').style.display = 'block';
        }, 2000);
    </script>
@endpush
