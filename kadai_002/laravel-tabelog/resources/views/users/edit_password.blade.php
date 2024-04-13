@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">パスワード変更</li>
        </ol>
    </nav>

    <!-- パースワード変更 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">

            <h1 class="my-3 text-center">パースワード変更</h1>
            <hr>

            <form method="post" action="{{route('mypage.update_password')}}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row my-4 mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-right">新しいパスワード</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control nagoyameshi-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認用</label>
                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control nagoyameshi-input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>


                <button type="submit" class="btn shadow-sm nagoyameshi-button w-100 mb-4">
                    パスワード更新
                </button>
            </form>
        </div>
    </div>

</div>

@endsection