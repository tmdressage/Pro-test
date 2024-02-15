@extends('layouts.app_home')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
@if($shops->isEmpty())
<div class="alert">検索結果はありませんでした</div>
@endif
@if (session('result'))
<div class="alert">{{ session('result') }}</div>
@endif
<div class="home__content">
    @foreach($shops as $shop)
    <div class="home__content--card">
        <div class="card-img">
            <img class="shop-img" src="{{ $shop->shop_img }}" alt="shop">
        </div>
        <div class="card-text">
            <h3 class="shop-name">{{ $shop->shop_name }}</h3>
            <div class="shop-tag">
                <p class="shop-area">#{{ $shop->shop_area }}</p>
                <p class="shop-genre">#{{ $shop->shop_genre }}</p>
            </div>
        </div>
        <div class="card-button">
            <div class="detail">
                <form action="{{ route('detail', ['shop_id' => $shop->id]) }}" method="get">
                    @csrf
                    <button class="detail-button" type="submit">詳しくみる</button>
                </form>
            </div>
            <form action="{{ route('review_read', ['shop_id' => $shop->id]) }}" method="get">
                <div class="review-read">
                    <button class="review-read-button" type="submit" name="review">★</button>
                    <p class="tooltip">レビュー閲覧</p>
                </div>
            </form>
            @if (Auth::check())
            @if($shop->already_favorite())
            <div class="favorite">
                <button class="favorite-button isActive" type="submit" name="favorite" data-shop-id="{{ $shop->id }}">❤</button>
                <p class="tooltip">お気に入り</p>
            </div>
            @else
            <div class="favorite">
                <button class="favorite-button notActive" type="submit" name="favorite" data-shop-id="{{ $shop->id }}">❤</button>
                <p class="tooltip">お気に入り</p>
            </div>
            @endif
            @else
            <form class="favorite" action="{{ route('login') }}" method="get">
                <button class="favorite-button-notLogin" type="submit">❤</button>
                <p class="tooltip">お気に入り</p>
            </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection