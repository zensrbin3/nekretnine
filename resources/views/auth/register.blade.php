@extends('layouts.app')
@section('content')
    @include('includes.navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>User register</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="mt-1">
                                    <div class="progress">
                                        <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <small id="password-strength-text" class="text-muted"></small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    <script>
        const password = document.getElementById('password');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        password.addEventListener('input', function() {
            const val = password.value;
            let strength = 0;
            if(val.length >= 6) strength++;
            if(val.match(/[A-Z]/)) strength++;
            if(val.match(/[0-9]/)) strength++;
            if(val.match(/[\W]/)) strength++;
            switch(strength) {
                case 0:
                    strengthBar.style.width = '0%';
                    strengthBar.className = 'progress-bar bg-danger';
                    strengthText.textContent = '';
                    break;
                case 1:
                    strengthBar.style.width = '25%';
                    strengthBar.className = 'progress-bar bg-danger';
                    strengthText.textContent = 'Slaba lozinka';
                    break;
                case 2:
                    strengthBar.style.width = '50%';
                    strengthBar.className = 'progress-bar bg-warning';
                    strengthText.textContent = 'Srednja lozinka';
                    break;
                case 3:
                    strengthBar.style.width = '75%';
                    strengthBar.className = 'progress-bar bg-info';
                    strengthText.textContent = 'Dobra lozinka';
                    break;
                case 4:
                    strengthBar.style.width = '100%';
                    strengthBar.className = 'progress-bar bg-success';
                    strengthText.textContent = 'Jaka lozinka';
                    break;
            }
        });
    </script>
@endpush
