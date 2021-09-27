@extends('layouts.app')

@section('content')
    <div class="reset-password-section">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-body-title">{{ __('Reset Password') }}</div>
                            <div class="card-body-subtitle">Enter email to reset your password</div>

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group container form-group-enter-email-in-reset-password">

                                    <label for="email">{{ __('Email:') }}</label>

                                    <div>
                                        <input id="email" type="email"
                                            class="form-control input-style @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-5 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-reset-password">
                                            {{ __('RESET PASSWORD') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
