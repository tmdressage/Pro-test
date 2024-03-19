<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getHome()
    {
        $shops = Shop::all();
        return view('home', compact('shops'), ['keyword' => '']);
    }

    public function logoutGetHome()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getSelect(Request $request)
    {
        $sort = $request->input('sort');
        $area = $request->input('area');
        $genre = $request->input('genre');
        $keyword = $request->input('keyword');

        $query = Shop::query();

        if ($sort == '評価が高い順') {
            $query->leftjoin('ratings', 'ratings.shop_id', '=', 'shops.id')->select('shops.id', DB::raw('CEIL(AVG(rating) * 100) / 100 as average_rate'), 'shop_name', 'shop_img', 'shop_area', 'shop_genre')->groupBy('shops.id')->orderByRaw('average_rate IS NULL ASC')->orderByDesc('average_rate');

        }

        if ($sort == '評価が低い順') {
            $query->leftjoin('ratings', 'ratings.shop_id', '=', 'shops.id')->select('shops.id', DB::raw('CEIL(AVG(rating) * 100) / 100 as average_rate'), 'shop_name', 'shop_img', 'shop_area', 'shop_genre')->groupBy('shops.id')->orderByRaw('average_rate IS NULL ASC')->orderBy('average_rate');
        }

        if ($sort == 'ランダム') {
            $query->orderByRaw('RAND()');
        }

        if (!empty($area)) {
            $query->where('shop_area', 'LIKE', $area);
        }

        if (!empty($genre)) {
            $query->where('shop_genre', 'LIKE', $genre);
        }

        if (!empty($keyword)) {
            $query->where('shop_name', 'LIKE', "%{$keyword}%");
        }

        $shops = $query->get();

        return view('home', compact('shops', 'sort', 'area', 'genre', 'keyword'));
    }
}
