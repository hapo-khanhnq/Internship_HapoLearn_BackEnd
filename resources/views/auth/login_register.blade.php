<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="close-modal-button" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">REGISTER</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form class="login-form" method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <div class="form-group">
                                <label for="inputEmailLogin" class="form-group-title">Email:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmailLogin" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordLoign" class="form-group-title">Password:</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPasswordLoign" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember me</label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-pw-link">Forgot password</a>
                                @endif
                            </div>
                            <button type="submit" class="login-button">
                                {{ __('Login') }}
                            </button>
                            <span class="social-network-login-title">Login with</span>
                            <a href="#" class="login-with-google"><img src="{{ asset('images/google_icon.png') }}" alt="google-icon">&nbsp; Google</a>
                            <a href="#" class="login-with-facebook"><img src="{{ asset('images/facebook_icon.png') }}" alt="facebook icon">&nbsp; Facebook</a>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form class="register-form" method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <div class="form-group">
                                <label for="inputUserNameRegister" class="form-group-title">Username:</label>
                                <input type="text" class="form-control @error('register_name') is-invalid @enderror" name="register_name" value="{{ old('register_name') }}" id="inputUserNameRegister" required autocomplete="name" autofocus>

                                @error('register_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmailRegister" class="form-group-title">Email:</label>
                                <input type="email" class="form-control @error('register_email') is-invalid @enderror" name="register_email" value="{{ old('register_email') }}" id="inputEmailRegister" required autocomplete="email">

                                @error('register_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordRegister" class="form-group-title">Password:</label>
                                <input type="password" class="form-control @error('register_password') is-invalid @enderror" name="register_password" id="inputPasswordRegister" required autocomplete="new-password">

                                @error('register_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputRepeatPasswordRegister" class="form-group-title">Repeat Password:</label>
                                <input type="password" class="form-control" id="inputRepeatPasswordRegister" name="register_password_confirmation" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="register-button">
                                {{ __('Register') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
