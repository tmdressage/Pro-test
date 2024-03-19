<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Rating;
use App\Http\Requests\RatingRequest;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function getRating($shop_id)
    {
        $user = Auth::User();
        $shop = Shop::find($shop_id);

        if (Rating::where('user_id', $user->id)->where('shop_id', $shop_id)->first()) {
            return redirect('/')->with('error', '既にこの飲食店の口コミを投稿しています');
        }

        return view('rating', compact('shop'));
    }

    public function postRating(RatingRequest $request, $shop_id)
    {
        $user = Auth::User();
        $shop = Shop::find($shop_id);
        $rating = $request->input('rating');
        $text = $request->input('text');
        $img = $request->file('image');

        if ($img) {
            $dir = 'img';
            $file_name = $img->getClientOriginalName();
            $img->storeAs('public/' . $dir, $file_name);
            $image = 'storage/' . $dir . '/' . $file_name;

            try {
                Rating::create([
                    'user_id' => $user->id,
                    'shop_id' => $shop->id,
                    'rating' => $rating,
                    'text' => $text,
                    'image' => $image,
                ]);
                return redirect()->route('detail', ['shop_id' => $shop_id]);
            } catch (\Throwable $th) {
                return redirect('/')->with('error', '予期せぬエラーが発生しました');
            }
        } else {
            try {
                Rating::create([
                    'user_id' => $user->id,
                    'shop_id' => $shop->id,
                    'rating' => $rating,
                    'text' => $text,
                    'image' => $img,
                ]);
                return redirect()->route('detail', ['shop_id' => $shop_id,]);
            } catch (\Throwable $th) {
                return redirect('/')->with('error', '予期せぬエラーが発生しました');
            }
        }
    }

    public function RatingEdit($shop_id)
    {
        $shop = Shop::find($shop_id);
        $user_id = Auth::user()->id;
        $rating = Rating::where('user_id', $user_id)->where('shop_id', $shop_id)->first();

        return view('rating', compact('shop', 'rating'));
    }


    public function RatingEdited(RatingRequest $request, $shop_id)
    {

        $user = Auth::User();
        $rating = $request->input('rating');
        $text = $request->input('text');
        $img = $request->file('image');


        if ($img) {
            $dir = 'img';
            $file_name = $img->getClientOriginalName();
            $img->storeAs('public/' . $dir, $file_name);
            $image = 'storage/' . $dir . '/' . $file_name;

            try {
                Rating::where('user_id', $user->id)->where('shop_id', $shop_id)->update([
                    'rating' => $rating,
                    'text' => $text,
                    'image' => $image,
                ]);
                return redirect()->route('detail', ['shop_id' => $shop_id,]);
            } catch (\Throwable $th) {
                return redirect('/')->with('error', '予期せぬエラーが発生しました');
            }
        } else {
            try {
                Rating::where('user_id', $user->id)->where('shop_id', $shop_id)->update([
                    'rating' => $rating,
                    'text' => $text,
                    'image' => $img,
                ]);
                return redirect()->route('detail', ['shop_id' => $shop_id,]);
            } catch (\Throwable $th) {
                return redirect('/')->with('error', '予期せぬエラーが発生しました');
            }
        }
    }
}
