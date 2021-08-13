<!-- Modal -->
<div class="modal fade login-register" id="login-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-modal-custom">
            <div class="modal-body p-0">
                <button type="button" class="close close-button-login-register" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

                <ul class="nav nav-tabs p-0 login-register-bar" id="myTab" role="tablist">
                    <li class="nav-item w-50">
                        <a class="nav-link active login-nav-tab active-tab" id="login-nav-tab" data-toggle="tab" href="#login-tab" role="tab" aria-controls="home" aria-selected="true">LOGIN</a>
                    </li>
                    <li class="nav-item w-50">
                        <a class="nav-link register-nav-tab" id="register-nav-tab" data-toggle="tab" href="#register-tab" role="tab" aria-controls="profile" aria-selected="false">REGISTER</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <!-- login -->
                    <div class="tab-pane fade show active" id="login-tab" role="tabpanel">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mt-4 container">
                                <label for="email" class="label-text-style">Username:</label>
                                <div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input-style" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback invalid-feedback-modal" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group container">
                                <label for="password" class="label-text-style">Password:</label>
                                <div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror input-style" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback invalid-feedback-modal" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="remember-me-and-forgot-password-div">
                                <div class="form-check d-block">
                                    <input class="form-check-input remember-me-login-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label remember-me-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    @if (Route::has('password.request'))
                                    <a class="d-block forgot-password-txt" href="{{ route('password.request') }}">
                                        {{ __('Forgot password') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn button-login">LOGIN</button>
                            </div>
                            <div class="mt-4 mb-sm-5 mb-4 login-with-txt">Login with</div>
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <a href="#" class="login-with-google"><i class="fab fa-google-plus-g mr-2"></i>
                                    Google</a>
                                <a href="#" class="mb-5 login-with-facebook"><i class="fab fa-facebook-f mr-2"></i>
                                    Facebook</a>
                            </div>
                        </form>
                    </div>

                    <!-- register -->
                    <div class="tab-pane fade" id="register-tab" role="tabpanel" aria-labelledby="profile-tab">
                        <form class="container" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group mt-4">
                                <label for="username-register" class="label-text-style">Username:</label>
                                <div>
                                    <input id="name" type="text" class="form-control form-input @error('name') is-invalid @enderror input-style" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback invalid-feedback-modal" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email-register" class="label-text-style">Email:</label>
                                <div>
                                    <input id="email-register" type="email" class="form-control @error('email_register') is-invalid @enderror input-style" name="email_register" value="{{ old('email_register') }}" required autocomplete="email_register">

                                    @error('email_register')
                                    <span class="invalid-feedback invalid-feedback-modal" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-register" class="label-text-style">Password</label>
                                <div>
                                    <input id="password-register" type="password" class="form-control @error('password_register') is-invalid @enderror input-style" name="password_register" required autocomplete="new-password">

                                    @error('password_register')
                                    <span class="invalid-feedback invalid-feedback-modal" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repeat-password-register" class="label-text-style">Repeat
                                    Password:</label>
                                <div>
                                    <input id="repeat-password-register" type="password" class="form-control input-style" name="password_register_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="d-flex mb-5 justify-content-center mt-5">
                                <button type="submit" class="btn button-login">REGISTER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
