@extends('layouts.app')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">
            <h1 class="text-center py-3">{{ __('Reset Password') }}</h1>

            <hr class="w-100 m-auto py-3">

            <div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-input" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror nagoyameshi-input" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control nagoyameshi-input" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 offset-md-4 my-3">
                            <button type="submit" class="btn nagoyameshi-button shadow-sm">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
