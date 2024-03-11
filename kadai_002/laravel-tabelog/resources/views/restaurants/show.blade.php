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
                        <a href="/restaurants/{{ $restaurant->id }}/favorite" class="btn nagoyameshi-favorite-button text-dark w-100">
                            <i class="fa fa-heart"></i>
                            お気に入り
                        </a>
                    </div>
                </div>
            </form>
            @endauth
        </div>

        <div class="offset-1 col-11">
            <hr class="w-100">
            <h3 class="float-left">レビュー</h3>
            <button type="submit" class="btn nagoyameshi-submit-button">
                レビュー投稿
            </button>
        </div>

        <div class="offset-1 col-10">
            <!-- レビューを実装する箇所になります -->
        </div>
    </div>
</div>
@endsection