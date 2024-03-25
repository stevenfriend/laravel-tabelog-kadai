@extends('layouts.app')

@section('content')

@php
    $subscribed = false;
@endphp

@auth
    @if(auth()->user()->subscribed('premium_plan'))
        @php
            $subscribed = true;
        @endphp
    @endif
@endauth

<nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
        <li class="breadcrumb-item"><a href="{{ route('restaurants.index') }}">店舗一覧</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $restaurant->name }}</li>
    </ol>
</nav>

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-4 rounded" id="restaurant-main-container">
    <div>
        <div id="restaurant-carousel" class="carousel slide mb-4">
            <!-- <div class="carousel-indicators">
                <button type="button" data-bs-target="#restaurant-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#restaurant-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#restaurant-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div> -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="{{ asset('img/dummy1.png')}}" class="carousel-img img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                <img src="{{ asset('img/dummy2.png')}}" class="carousel-img img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                <img src="{{ asset('img/dummy3.jpeg')}}" class="carousel-img img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                <img src="{{ asset('img/dummy4.jpg')}}" class="carousel-img img-fluid;" alt="...">
                </div>
                <div class="carousel-item">
                <img src="{{ asset('img/dummy5.jpg')}}" class="carousel-img img-fluid" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#restaurant-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">前へ</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#restaurant-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">次へ</span>
            </button>
        </div>

        <div class="mb-5">
            <h1>{{ $restaurant->name }}</h2>
            @php
                $fullStars = floor($rating);
                $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                $emptyStars = 5 - $fullStars - $halfStar;
            @endphp
            <div class="rating d-flex align-items-center">
                @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star rating-star"></i>
                @endfor
                @if ($halfStar)
                    <i class="fas fa-star-half-alt rating-star"></i>
                @endif
                @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="far fa-star rating-star"></i>
                @endfor
                <div class="px-2 fs-5"><b>{{ round($rating, 1) }}</b>（{{ $reviews_count }}件）</div>
            </div>
            <hr>
            <p class="fs-5">{{ $restaurant->description }}</p>
            <div class="row mb-2 g-2 pb-2">
                <div class="col">
                @if($subscribed)
                    <button type="button" class="btn btn-primary nagoyameshi-button w-100" data-bs-toggle="modal" data-bs-target="#reservationModal">
                        予約する
                    </button>
                @else
                    <button type="button" class="btn btn-primary nagoyameshi-button w-100" data-bs-toggle="modal" data-bs-target="#promotionModal">
                        予約する
                    </button>
                @endif
                </div>
                <div class="col">
                @if($subscribed)
                    @if($restaurant->isFavoritedBy(Auth::user()))
                    <a href="{{ route('restaurants.favorite', $restaurant) }}" class="btn nagoyameshi-button text-favorite w-100">
                        <i class="fa fa-heart"></i>お気に入り解除
                    </a>
                    @else
                    <a href="{{ route('restaurants.favorite', $restaurant) }}" class="btn btn-secondary w-100">
                        <i class="fa fa-heart"></i>お気に入り
                    </a>
                    @endif
                @else
                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#promotionModal">
                        <i class="fa fa-heart" ></i>お気に入り
                    </button>
                @endif
                </div>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                    <th scope="row" style="width: 100px;">営業時間</th>
                    <td>
                    @php
                    $openingTime = new DateTime($restaurant->opening_time);
                    $colsingTime = new DateTime($restaurant->closing_time);
                    @endphp
                    {{ $openingTime->format('H:i') }}〜{{ $colsingTime->format('H:i') }}
                    </th>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">定休日</th>
                    <td>{{ $restaurant->days_closed }}</td>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">座席数</th>
                    <td>{{ $restaurant->seating_capacity }}席</td>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">電話番号</th>
                    <td>{{ $restaurant->telephone }}</th>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">住所</th>
                    <td>
                        〒{{ $restaurant->postal_code }}<br>
                        {{ $restaurant->address }}
                    </td>
                    </tr>
                    <th scope="row" style="width: 100px;">カテゴリ</th>
                    <td>{{ $restaurant->category->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center w-100 mb-4 px-2">
            <h2 class="mb-0">レビュー</h3>
            <div class="ms-auto">
                @if($subscribed)
                    <button type="button" class="btn btn-primary nagoyameshi-button" data-bs-toggle="modal" data-bs-target="#reviewModal">
                        レビュー投稿
                    </button>
                @else
                    <button type="button" class="btn btn-primary nagoyameshi-button" data-bs-toggle="modal" data-bs-target="#promotionModal">
                        レビュー投稿
                    </button>
                @endif
            </div>
        </div>
        <hr>
        @foreach($reviews as $review)
        <div class="card mb-3">
            <h5 class="card-header bg-secondary text-white">{{ $review->user->name }}さん</h5>
            <div class="card-body">
                <div class="rating d-flex align-items-center mb-3">
                @php
                    $fullStars = floor($review->rating);
                    $halfStar = $review->rating - $fullStars >= 0.5 ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;
                @endphp
                @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star rating-star"></i>
                @endfor
                @if ($halfStar)
                    <i class="fas fa-star-half-alt rating-star"></i>
                @endif
                @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="far fa-star rating-star"></i>
                @endfor
                    <h5 class="card-title fw-bold mb-0 mx-2">{{$review->title}}</h5>
                </div>
                <p class="card-text fs-6">{{ $review->content }}</p>
                <div class="d-flex justify-content-between w-100">
                    <p class="card-text"><small class="text-body-secondary">{{ date("Y年m月d日", strtotime($review->created_at)); }} にレビュー済み</small></p>
                    @if($subscribed && auth()->user()->id === $review->user_id)
                    <form class="d-flex justify-content-end m-0" action="{{ route('reviews.destroy', ['review' => $review->id]) }}" method="POST">
                        <a href="#" class="btn btn-primary nagoyameshi-button ms-1">編集</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-1">削除</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        {{ $reviews->links() }}
</div>

@endsection

<!-- プロモモーダル -->
@include('modals.promotion')

<!-- 予約モーダル -->
@include('modals.reservation')

<!-- レビューモーダル -->
@include('modals.review')