@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.category_selector', ['categories' => $categories])
        @endcomponent
    </div>
    <div class="col-9">
        <h1>おすすめお店</h1>
        <div class="row">
            <div class="col-4">
                <a href="#">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-restaurant-label mt-2">
                            鮨 ながはま<br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <a href="#">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-restaurant-label mt-2">
                            寿司 しろ田<br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <a href="#">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-restaurant-label mt-2">
                            海鮮三崎港 名古屋店<br>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <h1>新着お店</h1>
        <div class="row">
            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-restaurant-label mt-2">
                            寿司 銀蔵<br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-restaurant-label mt-2">
                            3人掛けソファー<br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-restaurant-label mt-2">
                            すし政 名古屋駅前店<br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-restaurant-label mt-2">
                            鮨 ながはま<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection