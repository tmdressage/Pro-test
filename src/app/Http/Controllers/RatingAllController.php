<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingAllController extends Controller
{
    public function getRatingAll($shop_id)
    {
        $user = Auth::User();
        $shop = Shop::find($shop_id);  
        $ratings = Rating::where('shop_id', $shop_id)->orderBy('updated_at','DESC')->get();


        $average_rate = Rating::where('shop_id', $shop_id)->avg('rating');
        $roundAverage_rate = ceil($average_rate * 100) / 100;

        if (!$average_rate) {
            $average_rate = "--";
        }

        return view('rating_all', compact('shop', 'ratings', 'user','roundAverage_rate'));
    }

    public function postDelete($shop_id)
    {
        $user_id = Auth::user()->id;
        Rating::where('user_id', $user_id)->where('shop_id', $shop_id)->first()->delete();

        return redirect()->route('detail', ['shop_id' => $shop_id]);
    }


    public function postAdminDelete($rating_id)
    {
        Rating::where('id', $rating_id)->delete();

        return redirect()->back();
    }
 
}
