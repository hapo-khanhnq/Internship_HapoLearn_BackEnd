@extends('layouts.app')

@section('content')
<div class="container email-container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-top text-center">
                        Reset Password
                    </div>
                    <div class="card-header-bottom text-center">
                        Enter email to reset your password
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row flex-column">
                            <label for="email" class="col-md-4 col-form-label text-md-left offset-md-3">{{ __('E-Mail') }}</label>

                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4 button-submit">
                            <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                                <button type="submit" class="btn submit-email-button">
                                    reset password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
