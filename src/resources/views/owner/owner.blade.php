@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner.css') }}">
@endsection

@section('content')
<div class="owner__login-name">
    <p class="login-name">{{ Auth::user()->name }}さん</p>
    <p class="title">【店舗情報作成/編集画面】</p>
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
<div class="owner__content">
    <div class="owner__shop--registration">
        @if(isset($ownerShop))
        <p class="owner__shop--title">Shop Edition</p>
        @else
        <p class="owner__shop--title">Shop Registration</p>
        @endif
        <div class="owner__shop--form">
            <form class="form" action="{{ route('shop_register') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-name" src="img/shop.png" alt="Name">
                    </div>
                    <div class="form__group--content">
                        <div class="form__input--text">
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" placeholder="Shop-name" />
                        </div>
                        <div class="form__error">
                            @error('shop_name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-img" src="img/img.png" alt="Img">
                    </div>
                    <div class="form__group--content">
                        <div class="form__input">
                            <P class="text">Shop-img</P>
                            <input type="file" name="shop_img" value="{{ old('shop_img') }}">
                        </div>
                        <div class="form__error">
                            @error('shop_img')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-area" src="img/area.png" alt="Area">
                    </div>
                    <div class="form__group--content">
                        <?php
                        $select = isset($_GET['shop_area']) ? $_GET['shop_area'] : '';
                        ?>
                        <div class="search-area">
                            <select class="select-area" name="shop_area">
                                <option value="" disabled selected style="display:none;">Shop-area</option>
                                <option value="東京都" <?= $select === '東京都' ? ' selected' : ''; ?>>東京都</option>
                                <option value="大阪府" <?= $select === '大阪府' ? ' selected' : ''; ?>>大阪府</option>
                                <option value="福岡県" <?= $select === '福岡県' ? ' selected' : ''; ?>>福岡県</option>
                            </select>
                        </div>
                        <div class="form__error">
                            @error('shop_area')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-genre" src="img/genre.png" alt="Genre">
                    </div>
                    <div class="form__group--content">
                        <?php
                        $select = isset($_GET['shop_genre']) ? $_GET['shop_genre'] : '';
                        ?>
                        <div class="search-genre">
                            <select class="select-genre" name="shop_genre">
                                <option value="" disabled selected style="display:none;">Shop-genre</option>
                                <option value="寿司" <?= $select === '寿司' ? ' selected' : ''; ?>>寿司</option>
                                <option value="焼肉" <?= $select === '焼肉' ? ' selected' : ''; ?>>焼肉</option>
                                <option value="居酒屋" <?= $select === '居酒屋' ? ' selected' : ''; ?>>居酒屋</option>
                                <option value="イタリアン" <?= $select === 'イタリアン' ? ' selected' : ''; ?>>イタリアン</option>
                                <option value="ラーメン" <?= $select === 'ラーメン' ? ' selected' : ''; ?>>ラーメン</option>
                            </select>
                        </div>
                        <div class="form__error">
                            @error('shop_genre')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-text" src="img/text.png" alt="Text">
                    </div>
                    <div class="form__group--content">
                        <div class="form__input--text">
                            <textarea class="introduction" name="shop_text" cols="45" rows="4" placeholder="Introduction"></textarea>
                        </div>
                        <div class="form__error">
                            @error('shop_text')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                @if(isset($ownerShop))
                <div class="form__button">
                    <button class="form__button--submit" type="submit">
                        <p class="form__button--text">更新する</p>
                    </button>
                </div>
                @else
                <div class="form__button">
                    <button class="form__button--submit" type="submit">
                        <p class="form__button--text">登録する</p>
                    </button>
                </div>
                @endif
            </form>
        </div>
    </div>
    <div class="owner__shop--preview">
        <p class="owner__shop--preview-title">Shop Detail Preview</p>
        @if(isset($ownerShop))
        <div class="owner__shop--detail">
            <div class="detail__shop-name">
                {{ $ownerShop->shop_name }}
            </div>
            <div class="detail__shop-img">
                <img class="shop-img" src="{{ asset($ownerShop->shop_img) }}" alt="shop">
            </div>
            <div class="detail__shop-tag">
                <p class="shop-area">#{{ $ownerShop->shop_area }}</p>
                <p class="shop-genre">#{{ $ownerShop->shop_genre }}</p>
            </div>
            <h3 class="detail__shop-text">#{{ $ownerShop->shop_text }}</h3>
        </div>
        @else
        <div class="owner__shop--detail">
            <p>まだ店舗情報が登録されていません</p>
        </div>
        @endif
    </div>
</div>
@endsection