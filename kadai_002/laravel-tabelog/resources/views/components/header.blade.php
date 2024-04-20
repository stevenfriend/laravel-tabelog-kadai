<nav class="navbar navbar-expand-md navbar-light shadow-sm nagoyameshi-header-container d-flex flex-column">

    <div class="container d-flex justify-content-between align-items-center w-100">
        <!-- ブランディング -->
        <div>
            <a class="navbar-brand m-0" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <!-- 店舗検索 -->
        <form action="{{ route('restaurants.index') }}" method="GET">
        @csrf
            <div class="btn-group d-flex align-items-stretch" role="group" aria-label="search group">
                <button class="btn nagoyameshi-button nagoyameshi-category-button flex-shrink-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategories" aria-expanded="false" aria-controls="navbarCategories">
                    カテゴリ<i class="fas fa-chevron-down"></i>
                </button>
                <input type="text" name="keyword" class="form-control flex-fill nagoyameshi-search-input" placeholder="店舗名・カテゴリ">
                <button type="submit" class="btn nagoyameshi-button flex-shrink-0"><i class="fas fa-search nagoyameshi-header-search-icon"></i></button>
            </div>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ナビゲーション・リンク -->
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav text-center mt-2">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><b>{{ __('Register') }}</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><b>{{ __('Login') }}</b></a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mypage') }}"><b>マイページ</b></a>
                </li>
                @endguest
            </ul>
        </div>
    </div>

    <!-- カテゴリのボタン -->
    <div class="collapse" id="navbarCategories">
        <ul class="category-menu m-3">
        @foreach ($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('restaurants.index', ['category' => $category->id]) }}"><button class="btn btn-primary nagoyameshi-button category-button w-100" type="button">{{ $category->name }}</button></a>
            </li>
        @endforeach
        </ul>
    </div>

</nav>