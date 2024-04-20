<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // カスタムエラーメッセージの定義
        $messages = [
            'rating.required' => '評価を入力してください。',
            'rating.numeric' => '評価は数値である必要があります。',
            'rating.min' => '評価は0.5以上である必要があります。',
            'rating.max' => '評価は5以下である必要があります。',
            'title.required' => 'タイトルを入力してください。',
            'content.required' => '内容を入力してください。',
        ];

        // リクエストデータ用のバリデータを作成します。
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:.5|max:5',
            'title' => 'required',
            'content' => 'required',
        ], $messages);
    
        // バリデータが失敗した場合のチェック。
        if ($validator->fails()) {
            // エラーを名前付きエラーバッグでリダイレクトします。
            return back()->withErrors($validator, 'review')->withInput();
        }
    
        // 更新または新規レビューの判定。
        if ($request->input('method') === 'PUT') {
            $review = Review::find($request->input('review_id'));
            // レビューが存在することを確認するオプションのチェック。
            if (!$review) {
                // レビューが存在しない場合は、カスタムエラーメッセージと共にリダイレクトします。
                return back()->withErrors(['review' => 'レビューが見つかりませんでした。'])->withInput();
            }
        } else {
            $review = new Review;
        }
    
        // リクエストからレビューモデルにデータを設定します。
        $review->restaurant_id = $request->input('restaurant_id');
        $review->user_id = Auth::user()->id;
        $review->title = $request->input('title');
        $review->content = $request->input('content');
        $review->rating = $request->input('rating');
    
        // データベースにレビューを保存します。
        $review->save();
    
        // 保存/更新後にリダイレクトします。
        if ($request->input('method') === 'PUT') {
            return back()->with('review_edit_success', 'レビューが正常に編集されました。');
        } else {
            return back()->with('review_post_success', 'レビューが正常に投稿されました。');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('review_delete_success', 'レビューが正常に削除されました。');
    }
}
