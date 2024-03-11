@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-5 offset-1">
            <img src="{{ asset('img/dummy.png')}}" class="w-100 img-fluid">
        </div>
        <div class="col">
            <div class="d-flex flex-column">
                <h1 class="">
                    {{$restaurant->name}}
                </h1>
                <p class="">
                    {{$restaurant->description}}
                </p>
                <hr>
            </div>
            @auth
            <form method="POST" class="m-3 align-items-end">
                @csrf
                <input type="hidden" name="id" value="{{$restaurant->id}}">
                <input type="hidden" name="name" value="{{$restaurant->name}}">
                <div class="row">
                    <div class="col-7">
                        <button type="submit" class="btn nagoyameshi-submit-button w-100">
                            予約
                        </button>
                    </div>
                    <div class="col-5">
                    @if($restaurant->isFavoritedBy(Auth::user()))
                        <a href="{{ route('restaurants.favorite', $restaurant) }}" class="btn nagoyameshi-favorite-button text-favorite w-100">
                            <i class="fa fa-heart"></i>
                            お気に入り解除
                        </a>
                        @else
                        <a href="{{ route('restaurants.favorite', $restaurant) }}" class="btn nagoyameshi-favorite-button text-favorite w-100">
                            <i class="fa fa-heart"></i>
                            お気に入り
                        </a>
                        @endif
                    </div>
                </div>
            </form>
            @endauth
        </div>

        <div class="offset-1 col-11">
            <hr class="w-100">
            <h3 class="float-left">レビュー</h3>
        </div>

        <div class="offset-1 col-10">
            <div class="row">
                @foreach($reviews as $review)
                <div class="offset-md-5 col-md-5 pb-2">

                    <h3>{{$review->user->name}}</h3>

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
            </div><br />

            @auth
            <div class="row">
                <div class="offset-md-5 col-md-5">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <h4>レビュー内容</h4>
                        @component('components.star_rating')
                        @endcomponent
                        @error('content')
                            <strong>レビュー内容を入力してください</strong>
                        @enderror
                        <textarea name="content" class="form-control m-2"></textarea>
                        <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                        <button type="submit" class="btn nagoyameshi-submit-button ml-2">レビューを追加</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection