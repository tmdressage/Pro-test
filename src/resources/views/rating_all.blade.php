@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rating_all.css') }}">
@endsection

@section('content')
<div class="rating-all__title">
    <button class="back-button" type="button" onclick="history.back()">＜
    </button>
    <p class="title">【{{ $shop->shop_name }}】の全ての口コミ</p>
</div>
<div class="rating-all__content">
    <div class="rating-all__content--average">
        口コミ平均点：<p class="average"> ★{{ $roundAverage_rate}}
        </p> （5段階評価）
    </div>
    @if($ratings->isEmpty())
    <div class="empty-alert">! まだ口コミの投稿がありません</div>
    @endif
    <div class="rating-all__content--rating">
        @foreach($ratings as $rating)
        <div class="rating-all__shop-rating--posted">
            @if ($rating->user_id == $user->id)
            <div class="rating-all__shop-rating--edit">
                <form action="{{ route('edit', ['shop_id' => $shop->id]) }}" method="get">
                    @csrf
                    <input class="rating-all__shop-rating--change" type="submit" value="口コミを編集">
                </form>
                <form action="{{ route('rating_delete', ['shop_id' => $shop->id]) }}" method="post">
                    @csrf
                    <input class="rating-all__shop-rating--delete" type="submit" value="口コミを削除">
                </form>
            </div>
            @endif
            @can('admin')
            <div class="rating-all__shop-rating--edit">
                <form action="{{ route('admin_delete', ['rating_id' => $rating->id]) }}" method="post">
                    @csrf
                    <input class="rating-all__shop-rating--delete" type="submit" value="口コミを削除">
                </form>
            </div>
            @endcan
            <div class="rating-all__shop-rating--view">
                @if ($rating->rating == 5)
                <p class="posted-rating">非常に満足です</p>
                <span class="posted-star">★★★★★</span>
                @elseif ($rating->rating == 4)
                <p class="posted-rating">大変満足です</p>
                <span class="posted-star">★★★★☆</span>
                @elseif ($rating->rating == 3)
                <p class="posted-rating">満足です</p>
                <span class="posted-star">★★★☆☆</span>
                @elseif ($rating->rating == 2)
                <p class="posted-rating">少し不満足です</p>
                <span class="posted-star">★★☆☆☆</span>
                @elseif ($rating->rating == 1)
                <p class="posted-rating">不満足です</p>
                <span class="posted-star">★☆☆☆☆</span>
                @endif
                @if (isset($rating->text))
                <p class="posted-text">{{ $rating->text }}</p>
                @endif
                @if (isset($rating->image))
                <img class="posted-image" src="{{ asset($rating->image) }}" alt="image">
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection