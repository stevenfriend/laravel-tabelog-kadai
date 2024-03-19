@extends('layouts.app')

@section('content')

@php
    $paid_member = false;
@endphp

@auth
    @if(auth()->user()->paid_member)
        @php
            $paid_member = true;
        @endphp
    @endif
@endauth

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-1" style="max-width: 1000px;">
    <div class="card mb-3 w-100 p-2" style="max-width: 1000px;">
    <div class="row g-0">
        <div class="col-md-4 text-center">
        <img src="{{ asset('img/dummy.png')}}" class="img-fluid rounded" alt="resaturant">
        </div>
        <div class="col-md-8">
        <div class="card-body pb-0">
            <h1 class="card-title">{{$restaurant->name}}</h2>
            <p class="card-text"><small class="text-body-secondary">★ RATING</small></p>
            <hr>
            <p class="card-text">{{$restaurant->description}}</p>
            <div class="row mb-2 g-2">
            <div class="col">
            @if($paid_member)
                <button type="button" class="btn btn-primary nagoyameshi-button w-100" data-bs-toggle="modal" data-bs-target="#reservationModal">
                    予約をする
                </button>
            @else
                <button type="button" class="btn btn-primary nagoyameshi-button w-100" data-bs-toggle="modal" data-bs-target="#promotionModal">
                    予約をする
                </button>
            @endif
            </div>
            <div class="col">
            @if($paid_member)
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
                    <td>{{$restaurant->opening_time}}〜{{$restaurant->closing_time}}</th>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">定休日</th>
                    <td>{{$restaurant->days_closed}}</td>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">座席数</th>
                    <td>{{$restaurant->seating_capacity}}席</td>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">電話番号</th>
                    <td>{{$restaurant->telephone}}</th>
                    </tr>
                    <tr>
                    <th scope="row" style="width: 100px;">住所</th>
                    <td>
                        〒{{$restaurant->postal_code}}<br>
                        {{$restaurant->address}}
                    </td>
                    </tr>
                    <th scope="row" style="width: 100px;">カテゴリ</th>
                    <td>{{$restaurant->category->name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        <div class="d-flex align-items-center w-100 mb-2 px-2">
            <div>
                <h2 class="mb-0">レビュー</h3>
            </div>
            <div class="ms-auto">
                @if($paid_member)
                    <button type="button" class="btn btn-primary nagoyameshi-button" data-bs-toggle="modal" data-bs-target="#reviewModal">
                        レビューを投稿
                    </button>
                @else
                    <button type="button" class="btn btn-primary nagoyameshi-button" data-bs-toggle="modal" data-bs-target="#promotionModal">
                        レビューを投稿
                    </button>
                @endif
            </div>
        </div>
        <hr>
        @foreach($reviews as $review)
        <div class="offset-md-1 p-2">
            <h3>{{$review->user->nickname}}さん</h3>
            @php
                $fullStars = floor($review->rating); // Number of full stars
                $halfStar = $review->rating - $fullStars > 0 ? 1 : 0; // Determine if there's a half star
                $emptyStars = 5 - $fullStars - $halfStar; // Remaining are empty stars
            @endphp
            <div class="rating">
                @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star" style="color: #0fbe9f;"></i> {{-- Full Star --}}
                @endfor
                @if ($halfStar)
                    <i class="fas fa-star-half-alt" style="color: #0fbe9f;"></i> {{-- Half Star --}}
                @endif
                @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="far fa-star" style="color: #0fbe9f;"></i> {{-- Empty Star --}}
                @endfor
            </div>
            <p>{{$review->content}}</p>
            <label>{{$review->created_at}}</label>
        </div>
        @endforeach
    </div>
</div>

@endsection

<!-- プロモモーダル -->
@include('modals.promotion')

<!-- 予約モーダル -->
@include('modals.reservation')

<!-- レビューモーダル -->
@include('modals.review')