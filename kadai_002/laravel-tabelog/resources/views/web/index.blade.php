@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto" id="top-page-main-container">
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
    <div class="container mb-4 p-0">
        <h2 class="me-auto">おすすめのお店</h2>
        <div class="container p-0">
            <div class="row g-2">
            @foreach($recommended_restaurants as $restaurant)
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card">
                        <div class="card h-100">
                            @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                            <img src="{{ $restaurant->images[0]->file_path }}" class="card-img-top top-page-card-img" alt="{{ $restaurant->images[0]->description }}">
                            @else
                            <img src="{{ asset('img/nophoto.png') }}" class="card-img-top top-page-card-img" alt="画像なし">
                            @endif
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
                                        <i class="fas fa-star rating-star-small"></i>
                                    @endfor
                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt rating-star-small"></i>
                                    @endif
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star rating-star-small"></i>
                                    @endfor
                                    <div class="ps-2"><b>{{ round($rating, 1) }}</b>（{{ $restaurant->reviews_count }}件）</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    
    <div class="container mb-4 p-0">
        <h2 class="me-auto">評価が高いお店</h2>
        <div class="container p-0">
            <div class="row g-2">
            @foreach($ranked_restaurants as $restaurant)
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card">
                        <div class="card h-100">
                            @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                            <img src="{{ $restaurant->images[0]->file_path }}" class="card-img-top top-page-card-img" alt="{{ $restaurant->images[0]->description }}">
                            @else
                            <img src="{{ asset('img/nophoto.png') }}" class="card-img-top top-page-card-img" alt="画像なし">
                            @endif
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
                                        <i class="fas fa-star rating-star-small"></i>
                                    @endfor
                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt rating-star-small"></i>
                                    @endif
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star rating-star-small"></i>
                                    @endfor
                                    <div class="ps-2"><b>{{ round($rating, 1) }}</b>（{{ $restaurant->reviews_count }}件）</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>

    <div class="container p-0">
        <h2 class="me-auto">最新のお店</h2>
        <div class="container p-0">
            <div class="row g-2">
            @foreach($newest_restaurants as $restaurant)
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card">
                        <div class="card h-100">
                        @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                            <img src="{{ $restaurant->images[0]->file_path }}" class="card-img-top top-page-card-img" alt="{{ $restaurant->images[0]->description }}">
                        @else
                            <img src="{{ asset('img/nophoto.png') }}" class="card-img-top top-page-card-img" alt="画像なし">
                        @endif
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
                                        <i class="fas fa-star rating-star-small"></i>
                                    @endfor
                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt rating-star-small"></i>
                                    @endif
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star rating-star-small"></i>
                                    @endfor
                                    <div class="ps-2"><b>{{ round($rating, 1) }}</b>（{{ $restaurant->reviews_count }}件）</div>
                                </div>
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