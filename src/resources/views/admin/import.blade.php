@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/import.css') }}">
@endsection

@section('content')
<div class="import__login-name">
    <p class="login-name">{{ Auth::user()->name }}さん</p>
    <p class="title">【店舗情報CSVファイルインポート画面】</p>
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
<div class="import__content">
    <div class="import__shop--registration">
        <p class="import__shop--title">Csv File Import</p>
        <div class="import__shop--form">
            <h3 class="form__text">CSVファイルを選択してください</h3>
            <form class="form" method="post" action="{{ route('import_csv') }}" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="file" name="file" id="file">
                <div class="form__button">
                    <button class="form__button--submit" type="submit">
                        <p class="form__button--text">インポートする</p>
                    </button>
                    <div class="form__error">
                        @if (session('empty'))
                        {{ session('empty') }}
                        @endif
                        @error('file')
                        {{ $message }}
                        @enderror<br>
                        @error('*.0')
                        {{ $message }}
                        @enderror<br>
                        @error('*.1')
                        {{ $message }}
                        @enderror<br>
                        @error('*.2')
                        {{ $message }}
                        @enderror<br>
                        @error('*.3')
                        {{ $message }}
                        @enderror<br>
                        @error('*.4')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection