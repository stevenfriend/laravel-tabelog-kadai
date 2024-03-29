@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">ログイン</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">

        <div class="w-75">

            <h2 class="my-3 text-center">ログイン</h2>

            <hr>

            <p class="text-danger my-4 text-center">
                動作確認用アカウント<br>
                メールアドレス：user@example.com<br>
                パスワード：nagoyameshi<br>
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

            <div class="form-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>メールアドレスが正しくない可能性があります。</strong>
                </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror nagoyameshi-login-input" name="password" required autocomplete="current-password" placeholder="パスワード">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>パスワードが正しくない可能性があります。</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label nagoyameshi-check-label w-100" for="remember">
                        次回から自動的にログインする
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="mt-3 btn nagoyameshi-button w-100">
                    ログイン
                </button>

                <a class="mt-3 d-flex justify-content-center nagoyameshi-login-text" href="{{ route('password.request') }}">
                    パスワードをお忘れの場合
                </a>
            </div>
        </form>

        <hr>

        <div class="form-group">
            <a class="my-3 pb-3 d-flex justify-content-center nagoyameshi-login-text" href="{{ route('register') }}">
                新規登録
            </a>
        </div>
    </div>
</div>
@endsection