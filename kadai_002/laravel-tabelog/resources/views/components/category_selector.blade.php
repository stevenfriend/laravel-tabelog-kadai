<div class="container">
    @foreach ($categories as $category)
        <label class="category-label"><a href="{{ route('restaurants.index', ['category' => $category->id]) }}">{{ $category->name }}</a></label>
    @endforeach
 </div>