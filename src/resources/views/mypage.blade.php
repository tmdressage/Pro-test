@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage__login-name">
    <p class="login-name">{{ Auth::user()->name }}さん</p>
</div>
<div class="alert__content">
    @if (session('result'))
    <div class="alert__content--success">
        {{ session('result') }}
    </div>
    @elseif (session('error'))
    <div class="alert__content--error">
        {{ session('error') }}
    </div>
    @endif
</div>
<div class="mypage__content">
    <div class="mypage__reservation">
        <div class="mypage__reservation--text">予約状況</div>
        @if($reservations->isEmpty())
        <div class="empty-alert">! 予約状況の登録がありません</div>
        @endif
        <div class="mypage__reservation--card">
            @foreach($reservations as $reservation)
            @if($reservation->reserve_datetime < $now) <div class="reservation-card-past">
                <div class="reservation-content">
                    <img class="icon-clock" src="img/clock.png" alt="clock">
                    <p class="reservation-content-title">予約{{ $loop->iteration }}</p>
                    <form class="review" action="{{ route('review',['reservation_id' => $reservation->id, 'shop_id' => $reservation->shop_id])}}" method="get">
                        @csrf
                        <button class="review-button" type="submit" name="review">★</button>
                        <p class="tooltip">レビュー投稿</p>
                    </form>
                    <form class="cancel" action="{{ route('cancel', ['reservation_id' => $reservation->id]) }}" method="post">
                        @csrf
                        <button type="submit"><img class="cancel-button" src="img/cancel.png" alt="cancel"></button>
                        <p class="tooltip">予約削除</p>
                    </form>
                </div>
                <div class="reservation-detail">
                    <table class="reservation-table">
                        <tr>
                            <td class="column-space">Shop</td>
                            <td class="column-space">{{ $reservation->shop_name }}</td>
                        </tr>
                        <tr>
                            <td class="column-space">Date</td>
                            <td class="column-space">{{ substr($reservation->reserve_datetime, 0, 10) }}</td>
                        </tr>
                        <tr>
                            <td class="column-space">Time</td>
                            <td class="column-space">{{ substr($reservation->reserve_datetime, 11, 5) }}</td>
                        </tr>
                        <tr>
                            <td class="column-space">Number</td>
                            <td class="column-space">{{ $reservation->reserve_number }}人</td>
                        </tr>
                    </table>
                </div>

        </div>
        @else
        <div class="reservation-card">
            <div class="reservation-content">
                <img class="icon-clock" src="img/clock.png" alt="clock">
                <p class="reservation-content-title">予約{{ $loop->iteration }}</p>
                <form class="change" action="{{ route('change',['reservation_id' => $reservation->id, 'shop_id' => $reservation->shop_id])}}" method="get">
                    @csrf
                    <button type="submit"><img class="change-button" src="img/change.png" alt="change"></button>
                    <p class="tooltip">予約変更</p>
                </form>
                <form class="cancel" action="{{ route('cancel', ['reservation_id' => $reservation->id]) }}" method="post">
                    @csrf
                    <button type="submit"><img class="cancel-button" src="img/cancel.png" alt="cancel"></button>
                    <p class="tooltip">予約削除</p>
                </form>
            </div>
            <div class="reservation-detail">
                <table class="reservation-table">
                    <tr>
                        <td class="column-space">Shop</td>
                        <td class="column-space">{{ $reservation->shop_name }}</td>
                    </tr>
                    <tr>
                        <td class="column-space">Date</td>
                        <td class="column-space">{{ substr($reservation->reserve_datetime, 0, 10) }}</td>
                    </tr>
                    <tr>
                        <td class="column-space">Time</td>
                        <td class="column-space">{{ substr($reservation->reserve_datetime, 11, 5) }}</td>
                    </tr>
                    <tr>
                        <td class="column-space">Number</td>
                        <td class="column-space">{{ $reservation->reserve_number }}人</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<div class="mypage__favorite">
    <div class="mypage__favorite--text">お気に入り店舗</div>
    @if($favorites->isEmpty())
    <div class="empty-alert">! お気に入り店舗の登録がありません</div>
    @endif
    <div class="mypage__favorite--card">
        @foreach($shops as $shop)
        @if($shop->already_favorite())
        <div class="shop-card">
            <div class="card-img">
                <img class="shop-img" src="{{ asset($shop->shop_img) }}" alt="shop">
            </div>
            <div class="card-text">
                <h3 class="shop-name">{{ $shop->shop_name }}</h3>
                <div class="card-tag">
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
                    @csrf
                    <div class="review-read">
                        <button class="review-read-button" type="submit" name="review">★</button>
                        <p class="tooltip">レビュー閲覧</p>
                    </div>
                </form>
                <div class="favorite">
                    <button class="favorite-button isActive" type="submit" name="favorite" data-shop-id="{{ $shop->id }}">❤</button>
                    <p class="tooltip">お気に入り</p>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection