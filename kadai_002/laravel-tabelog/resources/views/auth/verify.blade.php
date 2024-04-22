@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">メール確認通知</li>
        </ol>
    </nav>

    <!-- メール確認通知 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">
            <h1 class="my-3 text-center">会員登録ありがとうございます！</h1>
            <hr class="pt-3">
            <h5 class="text-center pb-3">現在、仮会員の状態です。</h5>
            <h5 class="text-center pb-3">ただいま、ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。</h5>
            <h5 class="text-center pb-3">メール本文内のURLをクリックすると本会員登録が完了となります。</h5>
            <hr class="pb-3">
            <p class="text-center pb-3">もしメールが届いてない場合は、以下のボタンをクリックしてメールを再送信してください</p>
            <form class="d-flex justify-content-center" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn nagoyameshi-button mb-3">確認メールを再送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection