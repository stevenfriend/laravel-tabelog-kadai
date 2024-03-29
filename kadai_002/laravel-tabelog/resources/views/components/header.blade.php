<nav class="navbar navbar-expand-md navbar-light shadow-sm nagoyameshi-header-container d-flex flex-column">
    <div class="container d-flex justify-content-between align-items-center w-100">
        <div>
            <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <form action="{{ route('restaurants.index') }}" method="GET">
        @csrf
            <div class="btn-group d-flex align-items-stretch" role="group" aria-label="search group">
                <button class="btn nagoyameshi-button nagoyameshi-category-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategories" aria-expanded="false" aria-controls="navbarCategories">
                    カテゴリ<i class="fas fa-chevron-down"></i>
                </button>
                <input type="text" name="keyword" class="form-control nagoyameshi-search-input" placeholder="店舗名・カテゴリ">
                <button type="submit" class="btn nagoyameshi-button"><i class="fas fa-search nagoyameshi-header-search-icon"></i></button>
            </div>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mr-5 mt-2">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <hr>
                @else
                <li class="nav-item mr-5">
                    <a class="nav-link" href="{{ route('mypage') }}"><label>マイページ</label></a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
    <div class="collapse" id="navbarCategories">
        <ul class="category-menu m-3">
        @foreach ($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('restaurants.index', ['category' => $category->id]) }}"><button class="btn btn-primary nagoyameshi-button category-button" type="button">{{ $category->name }}</button></a>
            </li>
        @endforeach
        </ul>
    </div>
</nav>