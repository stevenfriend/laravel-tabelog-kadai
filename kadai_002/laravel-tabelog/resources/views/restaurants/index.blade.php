@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-9">
        <div class="container">
            @if ($category !== null)
                <h1>{{ $category->name }}のお店 全{{$total_count}}件</h1>
            @endif
        </div>
        <div class="container mt-4">
            <div class="row w-100">
                @foreach($restaurants as $restaurant)
                <div class="col-3">
                    <a href="{{route('restaurants.show', $restaurant)}}">
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <p class="nagoyameshi-restaurant-label mt-2">
                                {{$restaurant->name}}<br>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $restaurants->links() }}
        </div>
    </div>
</div>
@endsection