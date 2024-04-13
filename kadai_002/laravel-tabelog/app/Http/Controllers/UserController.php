<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('users.mypage', compact('user', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'furigana' => ['required', 'regex:/^[\p{Katakana}ー\x{0020}\x{3000}]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'telephone' => ['required', 'string', 'regex:/^\+?\d{2,3}-?\d{4}-?\d{4}$/'],
        ], [
            'name.required' => '名前は必須です。',
            'furigana.required' => 'フリガナは必須です。',
            'furigana.regex' => 'フリガナはカタカナで入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'telephone.required' => '電話番号は必須です。',
            'telephone.regex' => '有効な電話番号を入力してください。',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user->name = $request->input('name');
        $user->furigana = $request->input('furigana');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->update();
    
        return redirect()->route('mypage')->with('edit_user_success', '会員情報が正常に編集されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function edit_password()
    {
        return view('users.edit_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $user = Auth::user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('mypage')->with('change_password_success', 'パスワードが正常に変更されました。');
    }

    public function favorite()
    {
        $user = Auth::user();
    
        $favorites = $user->favorites(Restaurant::class)->with([
            'favoriteable' => function ($query) {
                $query->select(['id', 'name', 'description', 'category_id'])
                      ->with(['category' => function ($query) {
                          $query->select(['id', 'name']);
                      },
                      'images' => function ($query) {
                          $query->select(['id', 'restaurant_id', 'file_path', 'description']);
                      },
                      'reviews' => function ($query) {
                          $query->select('restaurant_id', 'rating');
                      }]);
            }
        ])->paginate(15);;
    
        foreach ($favorites as $favorite) {
            if (isset($favorite->favoriteable)) {
                $restaurant = $favorite->favoriteable;
                $restaurant->reviews_avg_rating = $restaurant->reviews->avg('rating');
                $restaurant->reviews_count = $restaurant->reviews->count();
            }
        }
    
        return view('users.favorite', compact('favorites'));
    }
}
