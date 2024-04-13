<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $intent = Auth::user()->createSetupIntent();

        return view('subscription.create', compact('intent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->newSubscription('premium_plan', 'price_1OvrWxGpme5m4IYbWTA212da')->create($request->paymentMethodId);

        return redirect()->route('mypage')->with('subscription_success', '有料プランへのご登録、誠にありがとうございます。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $intent = Auth::user()->createSetupIntent();

        return view('subscription.edit', compact('user', 'intent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Auth::user()->updateDefaultPaymentMethod($paymentMethod);

        return redirect()->route('mypage')->with('subscription_payment_method', 'お支払い方法を正常に変更しました。');
    }

    /**
     * Cancel the subscription of a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return view('subscription.cancel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::user()->subscription('premium_plan')->cancelNow();

        return redirect()->route('mypage')->with('subscription_cancelation', '有料プランを解約しました。');
    }
}
