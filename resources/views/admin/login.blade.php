@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4">
                    {{ __('Login') }}
                </div>

                <div class="card-body p-4">
                    <form method="POST" name="loginForm" id="loginForm" action="">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter Email" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1 error-msg">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter Password" name="password" autocomplete="current-password">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1 error-msg">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Login') }}
                            </button>
                        </div>

                        {{-- Forgot password --}}
                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    <i class="bi bi-question-circle me-1"></i>{{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('public/js/common.js') }}"></script>
@endsection