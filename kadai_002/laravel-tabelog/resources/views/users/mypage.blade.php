@extends('layouts.app')

@section('content')


@php
    $subscribed = auth()->check() && auth()->user()->subscribed('premium_plan');
@endphp

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- セッションメッセージの種類を定義 -->
    @php
        $sessionMessages = ['edit_user_success', 'change_password_success','subscription_success', 'subscription_payment_method', 'subscription_cancelation'];
    @endphp

    <!-- セッションメッセージを表示 -->
    @foreach ($sessionMessages as $sessionMessage)
        @if (session($sessionMessage))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session($sessionMessage) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @break
        @endif
    @endforeach

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">マイページ</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">

            <h1 class="my-3 text-center">マイページ</h1>
            <hr>

            <!-- 会員情報の編集 -->
            <a class="w-100" href="{{ route('mypage.edit') }}">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border my-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-pen fa-3x"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">会員情報の編集</h3>
                        <p class="m-0">アカウント情報を編集できます</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x fa-fw"></i>
            </div>
            </a>

            @if($subscribed)

            <!-- 予約一覧 -->
            <a class="w-100" href="{{ route('mypage.reservation' )}}">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border mb-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-utensils fa-3x fa-fw"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">予約一覧</h3>
                        <p class="m-0">予約を確認できます</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x"></i>
            </div>
            </a>

            <!-- お気に入り -->
            <a class="w-100" href="{{ route('mypage.favorite') }}">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border mb-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-heart fa-3x fa-fw"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">お気に入り</h3>
                        <p class="m-0">お気に入りしたお店を見ます</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x"></i>
            </div>
            </a>

            <!-- 有料会員解約 -->
            <a class="w-100" href="{{ route('subscription.cancel') }}">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border mb-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-minus fa-3x fa-fw"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">有料会員解約</h3>
                        <p class="m-0">有料プランを解約します</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x"></i>
            </div>
            </a>

            <!-- 支払い情報の編集 -->
            <a class="w-100" href="{{ route('subscription.edit') }}">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border mb-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-credit-card fa-3x fa-fw"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">支払い情報の編集</h3>
                        <p class="m-0">クレジットカード情報を編集します</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x"></i>
            </div>
            </a>

            @else

            <!-- 有料会員登録 -->
            <a class="w-100" href="{{ route('subscription.create') }}">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border mb-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-plus fa-3x fa-fw"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">有料会員登録</h3>
                        <p class="m-0">有料プランに登録できます</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x"></i>
            </div>
            </a>

            @endif

            <!-- パスワード変更 -->
            <a class="w-100" href="{{ route('mypage.edit_password') }}">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border mb-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-lock fa-3x fa-fw"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">パスワード変更</h3>
                        <p class="m-0">パスワードを変更します</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x"></i>
            </div>
            </a>

            <!-- ログアウト -->
            <a class="w-100" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="container mypage-menu-item d-flex justify-content-between align-items-center border mb-4 px-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-sign-out-alt fa-3x fa-fw"></i>
                    <div class="ms-4 d-flex flex-column">
                        <h3 class="m-0">ログアウト</h3>
                        <p class="m-0">ログアウトします</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right fa-2x"></i>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            </a>

        </div>
    </div>

</div>

@endsection