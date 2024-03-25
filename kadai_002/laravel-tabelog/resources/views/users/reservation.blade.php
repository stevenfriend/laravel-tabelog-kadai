@extends('layouts.app')

@section('content')
<nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
        <li class="breadcrumb-item active" aria-current="page">予約一覧</li>
    </ol>
</nav>

<div class="container d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>予約一覧</h1>

        <div class="row">
            <div class="row">
                <div class="col-5">
                    <h2>店舗名</h2>
                </div>
                <div class="col">
                    <h2>予約時間</h2>
                </div>
                <div class="col">
                    <h2>人数</h2>
                </div>
            </div>
        </div>

        <hr>

        @foreach ($reservations as $reservation)
        <div class="row">
            <div class="col-5">
                <h3 class="my-1">{{$reservation->restaurant ? $reservation->restaurant->name : 'No Restaurant'}}</h3>
            </div>
            <div class="col">
                <h3 class="my-1">{{$reservation->reserved_datetime}}</h3>
            </div>
            <div class="col">
                <h3 class="my-1">{{$reservation->number_of_people}}</h3>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
</div>
@endsection