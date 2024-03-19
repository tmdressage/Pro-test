<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Rating;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function getDetail($shop_id)
    {
        $shop = Shop::find($shop_id);

        if (!$shop) {
            return redirect('/')->with('error', '選択した飲食店の詳細情報が登録されていません');
        }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $rating = Rating::where('user_id', $user_id)->where('shop_id', $shop_id)->first();

            return view('detail', compact('shop', 'rating'));
        }

        return view('detail', compact('shop'));
    }


    public function postDetail($shop_id, ReservationRequest $request)
    {
        $user = Auth::user();
        $shop = Shop::find($shop_id);

        $date = $request->input('reserve_date');
        $time = $request->input('reserve_time');
        // dateとtimeを合成してdatetimeに変換
        $dateTime = $date . ' ' . $time;

        try {
            Reservation::create([
                'user_id' => $user->id,
                'shop_id' => $shop->id,
                'reserve_shop' => $shop->shop_name,
                'reserve_datetime' => $dateTime,
                'reserve_number' => $request->reserve_number
            ]);
            return redirect('done');
        } catch (\Throwable $th) {
            return redirect('/')->with('error', '予期せぬエラーが発生しました');
        }
    }

    public function RatingDelete($shop_id)
    {
        $user_id = Auth::user()->id;
        Rating::where('user_id', $user_id)->where('shop_id', $shop_id)->first()->delete();

        return redirect()->back();
        }

}
