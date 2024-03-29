<nav class="navbar navbar-expand-md navbar-light shadow-sm nagoyameshi-header-container d-flex flex-column">
  <div class="container d-flex align-items-center">
      <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'Laravel') }}
      </a>

      <button class="btn btn-secondary nagoyameshi-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategories" aria-expanded="false" aria-controls="navbarCategories">
          カテゴリ
      </button>
      
      <form class="row m-0">
      <div class="container d-flex align-items-center p-0">
          <input class="form-control nagoyameshi-header-search-input">
          <button type="submit" class="btn nagoyameshi-button h-100"><i class="fas fa-search nagoyameshi-header-search-icon"></i></button>
      </div>
      </form>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Right Side Of Navbar -->
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