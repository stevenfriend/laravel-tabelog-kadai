@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto" id="main-container">

<nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">店舗一覧</li>
    </ol>
</nav>

<div class="d-flex flex-column align-items-center justify-content-center bg-white mx-auto p-4 rounded">
    <div class="d-flex justify-content-between align-items-center w-100 mb-3">
    @if ($category == null)
        <div>
            <h1 class="m-0">（全{{ $restaurants->total() }}件）</h1>
        </div>
    @else
        <div>
            <h1 class="m-0">{{ $category->name }}のお店 （全{{ $restaurants->total() }}件）</h1>
        </div>
    @endif
        <div class="ms-auto">
            <form method="GET" action="{{ route('restaurants.index') }}">
                <input type="hidden" name="category" value="{{ $category->id ?? '' }}">
                <select class="form-select" name="sort_by" aria-label="Default select example" onchange="this.form.submit();">
                    <option value="" {{ request('sort_by') == '' ? 'selected' : '' }}>標準【PR店舗優先順】</option>
                    <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>評価が高い順</option>
                    <option value="created_at_desc" {{ request('sort_by') == 'created_at_desc' ? 'selected' : '' }}>掲載日が新しい順</option>
                </select>
            </form>
        </div>
    </div>
    @foreach($restaurants as $restaurant)
    <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-sm-4 img-container">
                <img src="{{ asset('img/dummy.png')}}" class="img-fluid rounded-start d-sm-rounded" alt="...">
                </div>
                <div class="col-sm-8 card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title m-0">{{ $restaurant->name }}</h3>
                        <p class="card-text text-body-secondary m-0">{{ $restaurant->category->name }}</p>
                    </div>
                    <!-- <hr> -->
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
                    @php
                        $description = $restaurant->description;
                        if(mb_strlen($description) > 50) {
                            $description = mb_substr($description, 0, 60) . "...詳細を見る";
                        }
                    @endphp
                    <p class="card-text">{{ $description }}</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach
    {{ $restaurants->links() }}
</div>
@endsection