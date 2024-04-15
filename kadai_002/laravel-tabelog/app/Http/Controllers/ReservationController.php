<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\AppImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::with('restaurant')
                    ->where('user_id', Auth::user()->id)
                    // 日付と時間を組み合わせて日時で並び替える
                    ->orderByRaw('CONCAT(reservation_date, " ", reservation_time) DESC')
                    ->paginate(15);

        return view('users.reservation', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // カスタムバリデーションルールを定義します。
        Validator::extend('not_past_time', function ($attribute, $value, $parameters, $validator) use ($request) {
            $reservationDateTime = Carbon::parse($request->input('reservation_date') . ' ' . $value);
            return !$reservationDateTime->isPast();
        }, '予約時間が過去の時間であってはならない。');

        Validator::extend('at_least_two_hours_ahead', function ($attribute, $value, $parameters, $validator) use ($request) {
            $reservationDate = $request->input('reservation_date');
            $reservationDateTime = Carbon::parse("$reservationDate $value");

            if (!$reservationDateTime->isToday()) {
                return true; // 予約日が今日ではない場合、このルールは適用されません。
            }

            $reservationDateTime = Carbon::parse($request->input('reservation_date') . ' ' . $value);
            $now = Carbon::now();
            return $now->diffInMinutes($reservationDateTime, false) >= 120;
        }, '今日の予約は現在時刻から少なくとも2時間先でなければならない。');

        Validator::extend('before_closing_time', function ($attribute, $value, $parameters, $validator) use ($request) {
            $restaurant = Restaurant::findOrFail($request->input('restaurant_id'));
            $closingTimeToday = Carbon::parse($request->input('reservation_date') . ' ' . $restaurant->closing_time);
            $reservationTime = Carbon::parse($request->input('reservation_date') . ' ' . $value);
            return $reservationTime->lessThanOrEqualTo($closingTimeToday->subHour());
        }, '予約時間はレストランの閉店時間の1時間前までに設定してください。');

        // カスタムエラーメッセージの定義
        $messages = [
            'reservation_date.required' => '予約日を入力してください。',
            'reservation_date.date' => '有効な日付を入力してください。',
            'reservation_date.after_or_equal' => '今日以降の日付を選択してください。',
            'reservation_time.required' => '予約時間を選択してください。',
            'number_of_people.required' => '人数を入力してください。',
            'number_of_people.integer' => '人数は整数で入力してください。',
            'number_of_people.min' => '少なくとも1人以上を選択してください。',
            'restaurant_id.required' => '予期せぬエラーが発生しました。',
            'restaurant_id.exists' => '予期せぬエラーが発生しました。',
        ];

        // リクエストデータのバリデーション
        $validator = Validator::make($request->all(), [
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => ['required', 'date_format:H:i', 'not_past_time', 'at_least_two_hours_ahead', 'before_closing_time'],
            'number_of_people' => 'required|integer|min:1',
            'restaurant_id' => 'required|exists:restaurants,id',
        ], $messages);
    
        // バリデータが失敗した場合
        if ($validator->fails()) {
            // 名前付きエラーバッグを使用してエラーをリダイレクト
            return back()->withErrors($validator, 'reservation')->withInput();
        }
    
        // 店舗の情報を取得
        $restaurant = Restaurant::findOrFail($request->input('restaurant_id'));
        // 定休日を配列に変換
        $daysClosed = json_decode($restaurant->days_closed);
    
        // 予約日の曜日を取得
        $reservationDayOfWeek = Carbon::parse($request->input('reservation_date'))->format('l');
    
        // 曜日を日本語に変換する配列
        $daysOfWeekInJapanese = [
            'Sunday' => '日',
            'Monday' => '月',
            'Tuesday' => '火',
            'Wednesday' => '水',
            'Thursday' => '木',
            'Friday' => '金',
            'Saturday' => '土',
        ];
        
        // 予約日の曜日を日本語に変換
        $japaneseDayOfWeek = $daysOfWeekInJapanese[$reservationDayOfWeek];
    
        // 予約日が店舗の定休日かどうかチェック
        if (in_array($reservationDayOfWeek, $daysClosed)) {
            return back()->withErrors(['reservation_date' => "{$japaneseDayOfWeek}曜日は定休日です。"], 'reservation')->withInput();
        }
    
        // 予約の新規作成
        $reservation = new Reservation();
        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->reservation_time = $request->input('reservation_time');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->restaurant_id = $request->input('restaurant_id');
        $reservation->user_id = Auth::user()->id;
        $reservation->save();
    
        // 成功した場合、前のページにリダイレクト
        return back()->with('reservation_success', 'ご予約ありがとうございます。お席を確保いたしました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->back()->with('reservation_delete_success', '予約が正常に削除されました。');
    }
}
