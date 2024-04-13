@extends('layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="{{ asset('/js/stripe.js') }}"></script>
@endpush

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">有料プラン登録</li>
        </ol>
    </nav>
    
    <!-- 有料プラン登録 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">
            <h1 class="my-3 text-center">有料プラン登録</h1>

            <hr>

            <p class="text-danger my-4 text-center">
                テストクレジットカード情報<br>
                カード番号：4242424242424242<br>
                月 / 年：12 / 34<br>
                セキュリティコード：123<br>
                郵便番号：45678<br>
            </p>
            @if (session('subscription_message'))
                <div class="alert alert-info" role="alert">
                    <p class="mb-0">{{ session('subscription_message') }}</p>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header text-center">
                    有料プランの内容
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-white">・当日の2時間前までならいつでも予約可能</li>
                    <li class="list-group-item bg-white">・店舗をお好きなだけお気に入りに追加可能</li>
                    <li class="list-group-item bg-white">・レビューを投稿可能</li>
                    <li class="list-group-item bg-white">・月額たったの300円</li>
                </ul>
            </div>

            <hr>

            <!-- エラー表示 -->
            <div class="alert alert-danger nagoyameshi-card-error" id="card-error" role="alert">
                <ul class="mb-0" id="error-list"></ul>
            </div>

            <form id="card-form" action="{{ route('subscription.store') }}" method="post">
                @csrf
                <input class="nagoyameshi-card-holder-name my-3" id="card-holder-name" type="text" placeholder="カード名義人" required>
                <div class="nagoyameshi-card-element mb-4" id="card-element"></div>
            </form>
            <div class="d-flex justify-content-center">
                <button class="btn text-white shadow-sm w-100 nagoyameshi-button mb-4" id="card-button" data-secret="{{ $intent->client_secret }}">登録</button>
            </div>
        </div>
    </div>

</div>

@endsection