@extends('layouts.app')
@section('content')
@php
    $user = Auth::user();
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4">
                    {{ !$user ? __('Register') : __('New User') }}
                </div>
                <div class="card-body p-4">
                    <form method="POST" name="registerForm" id="registerForm" enctype="multipart/form-data" action="">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Name" autocomplete="name" autofocus>
                            </div>
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter Email" autocomplete="email">
                            </div>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                    class="form-control @error('date_of_birth') is-invalid @enderror">
                            </div>
                            @error('date_of_birth') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('Phone No.') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter Phone Number" autocomplete="phone">
                            </div>
                            @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label for="role" class="form-label">{{ __('Role') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                <select id="role" name="role"
                                    class="form-control @error('role') is-invalid @enderror">
                                    <option value="">----Select Role----</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Profile Image --}}
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">{{ __('Profile Image') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                <input id="profile_image" type="file" name="profile_image"
                                    class="form-control @error('profile_image') is-invalid @enderror"
                                    accept="image/*">
                            </div>
                            @error('profile_image') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder=    "Enter Password" autocomplete="new-password">
                            </div>
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Enter Confirm Password" autocomplete="new-password">
                            </div>
                            @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary flex-fill me-2">
                                <i class="bi bi-person-plus-fill me-1"></i> {{ __('Register') }}
                            </button>
                            <a href="{{ !$user ? route('listing') : route('login') }}" class="btn btn-secondary flex-fill ms-2">
                                Cancel
                            </a>
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
<script>
$(document).ready(function ()
{
    //const user = @json(Auth::user());
    $('#registerForm').on('submit', function (e) {
        e.preventDefault();
        
        let form = $(this)[0]; // Get raw DOM form element
        let formData = new FormData(form);
        
        $('.invalid-feedback').remove(); // Clear old error messages
        $('.form-control').removeClass('is-invalid'); // Remove old classes

        $.ajax({
            url: "{{ url('register') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response)
            {
                $('#success-message').removeClass('d-none').text('Registration successful! Redirecting...');
                //if (!user)
                //{
                    //alert("in if");
                    window.location.href = "{{ url('login') }}";
                //} else {
                    //alert("in else");
                    //window.location.href = "{{ url('home') }}"; // fallback
                //}
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let input = $('#' + key);
                        input.addClass('is-invalid');
                        input.after('<span class="invalid-feedback d-block"><strong>' + value[0] + '</strong></span>');
                    });
                } else {
                    alert('An unexpected error occurred.');
                }
            }
        });
    });
});
</script>
@endsection
