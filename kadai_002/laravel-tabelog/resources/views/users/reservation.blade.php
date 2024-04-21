@extends('layouts.app')

@section('content')

@php
use Carbon\Carbon;
@endphp

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- セッションメッセージを表示 -->
    @if (session('reservation_delete_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('reservation_delete_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">予約一覧</li>
        </ol>
    </nav>

    <!-- 予約一覧 -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-100">

        <h1 class="my-3 text-center">予約一覧</h1>

        @foreach ($reservations as $reservation)

        <a href="{{ route('restaurants.show', $reservation->restaurant) }}" class="restaurant-card">
            <div class="card highlight-card shadow-sm mb-3 clickable">
                <div class="row g-0">
                    <div class="col-sm-4 img-container-reservations">
                        @if(isset($reservation->restaurant->images) && $reservation->restaurant->images->isNotEmpty())
                        <img src="{{ asset($reservation->restaurant->images[0]->file_path) }}" class="rounded-start" alt="{{ $reservation->restaurant->images[0]->description }}">
                        @else
                        <img src="{{ asset('img/nophoto.png') }}" class="rounded-start" alt="画像なし">
                        @endif
                    </div>
                    <div class="col-sm-8 card-body">
                        <h3 class="card-title m-0">{{ $reservation->restaurant->name }}</h3>
                        <hr>
                        <p class="mb-0"><b>予約日付：</b>{{ date("Y年m月d日", strtotime($reservation->reservation_date)) }}</p>
                        <p class="mb-0"><b>予約時間：</b>{{ date('H:i', strtotime($reservation->reservation_time)) }}</p>
                        <p class="mb-1"><b>予約人数：</b>{{ $reservation->number_of_people }}</p>
                        @php
                            $reservationDateTime = Carbon::parse($reservation->reservation_date . ' ' . $reservation->reservation_time);
                        @endphp
                        @if($reservationDateTime->isFuture())
                        <form class="floating-btn" action="{{ route('reservations.destroy', ['reservation' => $reservation->id]) }}" method="POST" onsubmit="return confirmCancellation()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">キャンセル</button>
                        </form>
                        <script>
                            function confirmCancellation() {
                                return confirm('キャンセルしてもよいですか？');
                            }
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        
        @endforeach
        
        <div class="d-flex justify-content-center">{{ $reservations->links('vendor.pagination.bootstrap-4') }}</div>
    </div>

</div>

@endsection