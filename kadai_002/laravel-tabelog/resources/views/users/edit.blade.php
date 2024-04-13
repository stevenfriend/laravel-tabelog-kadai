@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">員情報の編集</li>
        </ol>
    </nav>
    
    <!-- 会員情報の編集 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">

            <h1 class="my-3 text-center">会員情報の編集</h1>
            <hr>

            <form class="my-4" method="POST" action="{{ route('mypage') }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="name" class="text-md-left nagoyameshi-edit-user-info-label">氏名</label>
                    </div>
                    <div class="collapse show">
                        <input id="name" type="text" class="form-control nagoyameshi-input @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="furigana" class="text-md-left nagoyameshi-edit-user-info-label">フリガナ</label>
                    </div>
                    <div class="collapse show">
                        <input id="furigana" type="text" class="form-control nagoyameshi-input @error('furigana') is-invalid @enderror" name="furigana" value="{{ $user->furigana }}" required>
                        @error('furigana')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="email" class="text-md-left nagoyameshi-edit-user-info-label">メールアドレス</label>
                    </div>
                    <div class="collapse show editUserMail">
                        <input id="email" type="email" class="form-control nagoyameshi-input @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="telephone" class="text-md-left nagoyameshi-edit-user-info-label">電話番号</label>
                    </div>
                    <div class="collapse show">
                        <input id="telephone" type="tel" class="form-control nagoyameshi-input @error('telephone') is-invalid @enderror" name="telephone" value="{{ $user->telephone }}" required>
                        @error('telephone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn nagoyameshi-button mt-3 w-100">
                    保存
                </button>
            </form>
        </div>
    </div>

</div>

@endsection
