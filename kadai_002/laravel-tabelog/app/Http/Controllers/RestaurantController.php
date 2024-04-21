<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\AppImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Restaurant::with('reviews')->withAvg('reviews', 'rating')
                                            ->withCount('reviews')
                                            ->with('category')
                                            ->with('images');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('category', function($qr) use ($keyword) {
                      $qr->where('name', 'LIKE', "%{$keyword}%");
                  });
            });
        }
    
        switch ($request->input('sort_by')) {
            case 'rating_desc':
                $query->orderBy('reviews_avg_rating', 'desc')
                      ->orderBy('reviews_count', 'desc');
                break;
            case 'created_at_desc':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('recommend_flag', 'desc');
                break;
        }
    
        $restaurants = $query->paginate(15);
        $category = $request->filled('category') ? Category::find($request->category) : null;
        $keyword = $request->filled('keyword') ? $request->keyword : null;
    
        return view('restaurants.index', compact('restaurants', 'category', 'keyword'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $rating = $restaurant->reviews()->avg('rating');
        $reviews = $restaurant->reviews()->orderBy('created_at', 'desc')->paginate(5);
        $reviews_count = $restaurant->reviews()->count();

        return view('restaurants.show', compact('restaurant', 'rating', 'reviews', 'reviews_count'));
    }

    public function favorite(Restaurant $restaurant)
    {
        Auth::user()->togglefavorite($restaurant);

        return back();
    }
}
