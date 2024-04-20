<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Restaurant extends Model
{
    use HasFactory, Favoriteable;

    protected static function boot()
    {
        parent::boot();

        // レストランが削除されるとき、関連する画像も削除する
        static::deleting(function ($restaurant) {
            $restaurant->images->each(function ($image) {
                $image->delete();
                // ストレージから画像ファイルを削除する
                try {
                    if (Storage::disk('public')->exists($image->file_path)) {
                        Storage::disk('public')->delete($image->file_path);
                    } else {
                        Log::error("ファイルが見つかりませんでした； { $image->file_path }");
                    }
                } catch (\Exception $e) {
                    Log::error("ファイルの削除に失敗しました； { $e->getMessage() }");
                }
            });
        });
    }

    public function images()
    {
        return $this->hasMany(RestaurantImage::class);
    }

    // 取得時に文字列を配列として処理する
    public function getDaysClosedAttribute($value)
    {
        return explode(',', $value);
    }

    // 保存前に配列を文字列として処理す
    public function setDaysClosedAttribute($value)
    {
        $this->attributes['days_closed'] = implode(',', $value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
