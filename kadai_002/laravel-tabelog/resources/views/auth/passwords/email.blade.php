@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">
    
    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">パスワード再設定</li>
        </ol>
    </nav>

    <!-- パスワード再設定 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="text-center w-75">
            <h2 class="mt-3 mb-3">パスワード再設定</h2>

            <hr>

            <p class="my-4">
                ご登録時のメールアドレスを入力してください。<br>
                パスワード再発行用のメールをお送りします。  
            </p>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>メールアドレスが正しくない可能性があります。</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group my-3 pb-3">
                    <button type="submit" class="btn nagoyameshi-button w-100">
                        送信
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection