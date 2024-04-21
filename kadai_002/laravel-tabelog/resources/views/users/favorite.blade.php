@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">予約一覧</li>
        </ol>
    </nav>

    <!-- お気に入り -->
    <div class="d-flex justify-content-center bg-white rounded w-100 p-3">
        <div class="w-100">

        <h1 class="my-3 text-center">お気に入り</h1>

        @if ($favorites->isEmpty())
            <hr class="w-75 m-auto pb-1">
            <h3 class="my-3 text-center">現在、お気に入りのお店が登録されておりません。</h3>
        @else
            @foreach ($favorites as $favorite)
                @php
                    $restaurant = $favorite->favoriteable;
                @endphp
                <div class="card highlight-card shadow-sm mb-3 clickable" data-href="{{ route('restaurants.show', $restaurant) }}">
                    <div class="row g-0">
                        <div class="col-sm-4 img-container">
                            @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                            <img src="{{ asset($restaurant->images[0]->file_path) }}" class="rounded-start" alt="{{ $restaurant->images[0]->description }}">
                            @else
                            <img src="{{ asset('img/nophoto.png') }}" class="rounded-start" alt="画像なし">
                            @endif
                        </div>
                        <div class="col-sm-8 card-body d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="card-title m-0">{{ $restaurant->name }}</h3>
                                <p class="card-text text-body-secondary m-0">{{ $restaurant->category->name }}</p>
                            </div>
                            @php
                                $description = $restaurant->description;
                                if(mb_strlen($description) > 60) {
                                    $description = mb_substr($description, 0, 60) . "...詳細を見る";
                                }
                            @endphp
                            <p class="card-text m-0">{{ $description }}</p>
                            <!-- 店舗の平均評価 -->
                            @php
                            $rating = $restaurant->reviews_avg_rating;
                            $fullStars = floor($rating);
                            $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - $fullStars - $halfStar;
                            @endphp
                            <div class="rating d-flex align-items-center my-2">
                                @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star rating-star"></i>
                                @endfor
                                @if ($halfStar)
                                <i class="fas fa-star-half-alt rating-star"></i>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="far fa-star rating-star"></i>
                                @endfor
                                <div class="ps-2 fs-5"><b>{{ round($rating, 1) }}</b>（{{ $restaurant->reviews_count }}件）</div>
                            </div>
                            <a href="{{ route('restaurants.favorite', $restaurant) }}" class="btn nagoyameshi-button floating-btn text-favorite">
                                <i class="fa fa-heart"></i> 解除
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="d-flex justify-content-center">{{ $favorites->links('vendor.pagination.bootstrap-4') }}</div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.clickable').forEach(item => {
        item.addEventListener('click', function() {
            window.location.href = item.getAttribute('data-href');
        });
    });

    document.querySelectorAll('.btn.nagoyameshi-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
});
</script>

@endsection