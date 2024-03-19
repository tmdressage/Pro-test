@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_status.css') }}">
@endsection

@section('content')
<div class="reservation-status__login-name">
    <p class="login-name">{{ Auth::user()->name }}さん</p>
</div>
<div class="reservation-status__title">
    <button class="back-button" type="button" onclick="history.back()">＜
    </button>
    <p class="title">【{{ $ownerShop->shop_name }}】予約状況確認画面</p>
</div>
<div class="reservation-status__content">
    <div class="reservation-status__content--title">
        <table class="reservation-status-title">
            <tr>
                <td class="date">予約日</td>
                <td class="time">予約時間</td>
                <td class="number">予約人数</td>
                <td class="name">予約者</td>
            </tr>
        </table>
    </div>
    <div class="reservation-status__content--review">
        <table class="reservation-status-table">
            @foreach($reservations as $reservation)
            <tr>
                <td class="date">{{ substr($reservation->reserve_datetime, 0, 10) }}</td>
                <td class="time">{{ substr($reservation->reserve_datetime, 11, 5) }}</td>
                <td class="number">{{ $reservation->reserve_number }}人</td>
                <td class="name">{{ $reservation->name }}様</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection