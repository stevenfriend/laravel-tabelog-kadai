@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">新規会員登録</li>
        </ol>
    </nav>

    <!-- 新規会員登録 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">
                <h1 class="my-3 text-center">新規会員登録</h1>

                <hr class="pt-3">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror nagoyameshi-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="侍 太郎">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="furigana" class="col-md-5 col-form-label text-md-left">フリガナ<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="furigana" type="text" class="form-control @error('furigana') is-invalid @enderror nagoyameshi-input" name="furigana" value="{{ old('furigana') }}" required placeholder="サムライ タロウ">

                            @error('furigana')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-input" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="taro.samurai@example.com">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="telephone" class="col-md-5 col-form-label text-md-left">電話番号<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror nagoyameshi-input" name="telephone" value="{{ old('telephone') }}" required autocomplete="tel-national" placeholder="090-1234-5678">

                            @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-5 col-form-label text-md-left">パスワード<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror nagoyameshi-input" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3 pb-3">
                        <label for="password-confirm" class="col-md-5 col-form-label text-md-left">パスワード再入力<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="password-confirm" type="password" class="form-control nagoyameshi-input" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group my-3 pb-3">
                        <button type="submit" class="btn shadow-sm nagoyameshi-button w-100">
                            アカウント作成
                        </button>
                    </div>
                </form>

        </div>
    </div>

</div>
@endsection