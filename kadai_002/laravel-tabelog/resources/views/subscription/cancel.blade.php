@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">有料プラン解約</li>
        </ol>
    </nav>

    <!-- 有料プラン解約 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-75">
            <h1 class="my-3 text-center">有料プラン解約</h1>

            <p>有料プランを解約すると以下の特典を受けられなくなります。本当に解約してもよろしいですか？</p>

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

            <form id="cardForm" action="{{ route('subscription.destroy') }}" method="post">
                @csrf
                @method('delete')
                <div class="form-group d-flex justify-content-center">
                    <button class="btn btn-danger text-white shadow-sm w-100 mb-4">解約</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection