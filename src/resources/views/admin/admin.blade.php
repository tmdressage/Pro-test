@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__login-name">
    <p class="login-name">{{ Auth::user()->name }}さん</p>
    <p class="title">【店舗代表者登録画面】</p>
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
<div class="admin__content">
    <div class="admin__registration">
        <p class="admin__title">Owner Registration</p>
        <div class="admin__form">
            <form class="form" action="{{ route('owner_register') }}" method="post" novalidate>
                @csrf
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-name" src="img/person.png" alt="Name">
                    </div>
                    <div class="form__group--content">
                        <div class="form__input--text">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Ownername" />
                        </div>
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-mail" src="img/mail.png" alt="Mail">
                    </div>
                    <div class="form__group--content">
                        <div class="form__input--text">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group--icon">
                        <img class="icon-key" src="img/key.png" alt="Pass">
                    </div>
                    <div class="form__group--content">
                        <div class="form__input--text">
                            <input type="password" name="password" placeholder="Password" />
                        </div>
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button--submit" type="submit">
                        <p class="form__button--text">登録する</p>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="admin__owner-list">
        <p class="owner__title">Owner List</p>
        <div class="owner__form">
            <div class="owner__content">
                <div class="owner__content--text">
                    <table class="owner-text">
                        <tr>
                            <td class="id">owner_shop_id</td>
                            <td class="ownername">Ownername</td>
                            <td class="email">Email</td>
                        </tr>
                    </table>
                </div>
                <div class="owner__content--table">
                    <table class="owner-table">
                        @foreach($users as $user)
                        <tr>
                            <td class="id">{{ $user->owner_shop_id }}</td>
                            <td class="ownername">{{ $user->name }}</td>
                            <td class="email">{{ $user->email }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <p class="owner__content--memo">※owner_shop_idは店舗代表者が店舗情報を作成すると採番されます。</p>
            </div>
        </div>
    </div>
</div>
@endsection