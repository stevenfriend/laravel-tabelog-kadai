<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class WebController extends Controller
{
    public function index()
    {
        $getAllRestaurants = function () {
            return Restaurant::with('reviews')->withAvg('reviews', 'rating')->withCount('reviews');
        };

        $recommended_restaurants = $getAllRestaurants()->where('recommend_flag', true)->take(6)->get();
        $ranked_restaurants = $getAllRestaurants()->orderBy('reviews_avg_rating', 'desc')->take(6)->get();
        $newest_restaurants  = $getAllRestaurants()->orderBy('created_at', 'desc')->take(6)->get();

        return view('web.index', compact('recommended_restaurants', 'ranked_restaurants', 'newest_restaurants'));
    }
}
