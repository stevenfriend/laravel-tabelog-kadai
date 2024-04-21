@extends('layouts.app')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center mx-auto p-3" id="main-container">

    <!-- パンくずリスト -->
    <nav class="my-3 me-auto" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">店舗一覧</li>
        </ol>
    </nav>

    <div class="d-flex flex-column align-items-center justify-content-center bg-white mx-auto p-3 w-100 rounded">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
        @if ( $category !== null )
            <div>
                <h1 class="m-0">{{ $category->name }}のお店 （全{{ $restaurants->total() }}件）</h1>
            </div>
        @elseif ( $keyword !== null )
            <div>
                <h1 class="m-0">「{{ $keyword }}」の検索結果 （全{{ $restaurants->total() }}件）</h1>
            </div>
        @else
            <div>
                <h1 class="m-0">（全{{ $restaurants->total() }}件）</h1>
            </div>
        @endif
            <div class="ms-auto">
                <form method="GET" action="{{ route('restaurants.index') }}">
                    <input type="hidden" name="category" value="{{ $category->id ?? '' }}">
                    <input type="hidden" name="keyword" value="{{ $keyword }}">
                    <select class="form-select" name="sort_by" aria-label="Default select example" onchange="this.form.submit();">
                        <option value="" {{ request('sort_by') == '' ? 'selected' : '' }}>標準【PR店舗優先順】</option>
                        <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>評価が高い順</option>
                        <option value="created_at_desc" {{ request('sort_by') == 'created_at_desc' ? 'selected' : '' }}>掲載日が新しい順</option>
                    </select>
                </form>
            </div>
        </div>
        @if($restaurants->isEmpty())
            <h3 class="p-3 text-center">お探しのお店が見つかりませんでした。</h3>
        @else
            @foreach($restaurants as $restaurant)
            <a href="{{ route('restaurants.show', $restaurant) }}" class="restaurant-card w-100">
                <div class="card highlight-card shadow-sm mb-3">
                    <div class="row g-0">
                        <div class="col-sm-4 img-container">
                        @if(isset($restaurant->images) && $restaurant->images->isNotEmpty())
                            <img src="{{ asset($restaurant->images[0]->file_path) }}" class="rounded-start" alt="{{ $restaurant->images[0]->description }}">
                        @else
                            <img src="{{ asset('img/nophoto.png') }}" class="rounded-start" alt="画像なし">
                        @endif
                        </div>
                        <div class="col-sm-8 card-body">

                            <h3 class="card-title m-0">{{ $restaurant->name }}</h3>
                            <p class="card-text text-body-secondary m-0">{{ $restaurant->category->name }}</p>
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
                            @php
                                $description = $restaurant->description;
                                if(mb_strlen($description) > 60) {
                                    $description = mb_substr($description, 0, 60) . "...詳細を見る";
                                }
                            @endphp
                            <p class="card-text">{{ $description }}</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            {{ $restaurants->appends(['keyword' => request('keyword'), 'sort_by' => request('sort_by'), 'category' => request('category')])->links() }}
        @endif
        </div>

</div>

@endsection