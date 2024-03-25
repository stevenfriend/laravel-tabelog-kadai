@extends('layouts.app')

@section('content')

<nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">新規会員登録</li>
    </ol>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h3 class="mt-3 mb-3">新規会員登録</h3>

            <hr>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror nagoyameshi-login-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="furigana" class="col-md-5 col-form-label text-md-left">ふりがな<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="furigana" type="text" class="form-control @error('furigana') is-invalid @enderror nagoyameshi-login-input" name="furigana" value="{{ old('furigana') }}" required autocomplete="furigana" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名のふりがなを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nickname" class="col-md-5 col-form-label text-md-left">ニックネーム<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror nagoyameshi-login-input" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>ニックネームを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-login-input" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telephone" class="col-md-5 col-form-label text-md-left">電話番号<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="telephone" type="text" class="form-control @error('email') is-invalid @enderror nagoyameshi-login-input" name="telephone" value="{{ old('telephone') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>電話番号を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">パスワード<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror nagoyameshi-login-input" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-5 col-form-label text-md-left">パスワード（再入力）<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="password-confirm" type="password" class="form-control nagoyameshi-login-input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn nagoyameshi-submit-button w-100">
                        アカウント作成
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection