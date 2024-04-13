@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto" id="top-page-main-container">

    <!-- セッションメッセージを表示 -->
    @if (session('login_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('login_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('logout_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('logout_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="bg-white p-4 rounded">
        
        <!-- おすすめのお店 -->
        <div class="mb-5 p-0">
            <h2 class="me-auto">おすすめのお店</h2>
            <div class="container p-0">
                <div class="row g-3">
                    @foreach($recommended_restaurants as $restaurant)
                    <div class="col-md-4 col-sm-6 col-12">
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card">
                            <div class="card highlight-card shadow-sm h-100">
                                <div class="img-container">
                                    @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                                    <img src="{{ $restaurant->images[0]->file_path }}" class="card-img-top top-page-card-img" alt="{{ $restaurant->images[0]->description }}">
                                    @else
                                    <img src="{{ asset('img/nophoto.png') }}" class="card-img-top top-page-card-img" alt="画像なし">
                                    @endif
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title">{{ $restaurant->name }}</h5>
                                    <p class="card-text text-body-secondary m-0">{{ $restaurant->category->name }}</p>
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
                                        <div class="ps-2"><b>{{ round($rating, 1) }}</b>（{{ $restaurant->reviews_count }}件）</div>
                                    </div>
                                    @php
                                        $description = $restaurant->description;
                                        if(mb_strlen($description) > 50) {
                                            $description = mb_substr($description, 0, 50) . "...詳細を見る";
                                        }
                                    @endphp
                                    <p class="card-text">{{ $description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    
        <!-- 評価が高いお店 -->
        <div class="container mb-5 p-0">
            <h2 class="me-auto">評価が高いお店</h2>
            <div class="container p-0">
                <div class="row g-3">
                @foreach($ranked_restaurants as $restaurant)
                    <div class="col-md-4 col-sm-6 col-12">
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card">
                            <div class="card highlight-card shadow-sm h-100">
                                <div class="img-container">
                                    @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                                    <img src="{{ $restaurant->images[0]->file_path }}" class="card-img-top top-page-card-img" alt="{{ $restaurant->images[0]->description }}">
                                    @else
                                    <img src="{{ asset('img/nophoto.png') }}" class="card-img-top top-page-card-img" alt="画像なし">
                                    @endif
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title">{{ $restaurant->name }}</h5>
                                    <p class="card-text text-body-secondary m-0">{{ $restaurant->category->name }}</p>
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
                                        <div class="ps-2"><b>{{ round($rating, 1) }}</b>（{{ $restaurant->reviews_count }}件）</div>
                                    </div>
                                    @php
                                        $description = $restaurant->description;
                                        if(mb_strlen($description) > 50) {
                                            $description = mb_substr($description, 0, 50) . "...詳細を見る";
                                        }
                                    @endphp
                                    <p class="card-text">{{ $description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

        <!-- 最新のお店 -->
        <div class="container p-0">
            <h2 class="me-auto">最新のお店</h2>
            <div class="container p-0">
                <div class="row g-3">
                @foreach($newest_restaurants as $restaurant)
                    <div class="col-md-4 col-sm-6 col-12">
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card">
                            <div class="card highlight-card shadow-sm h-100">
                                <div class="img-container">
                                    @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                                    <img src="{{ $restaurant->images[0]->file_path }}" class="card-img-top top-page-card-img" alt="{{ $restaurant->images[0]->description }}">
                                    @else
                                    <img src="{{ asset('img/nophoto.png') }}" class="card-img-top top-page-card-img" alt="画像なし">
                                    @endif
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title">{{ $restaurant->name }}</h5>
                                    <p class="card-text text-body-secondary m-0">{{ $restaurant->category->name }}</p>
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
                                        <div class="ps-2"><b>{{ round($rating, 1) }}</b>（{{ $restaurant->reviews_count }}件）</div>
                                    </div>
                                    @php
                                        $description = $restaurant->description;
                                        if(mb_strlen($description) > 50) {
                                            $description = mb_substr($description, 0, 50) . "...詳細を見る";
                                        }
                                    @endphp
                                    <p class="card-text">{{ $description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

    </div>
<div>

@endsection