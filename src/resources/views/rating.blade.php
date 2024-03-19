@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rating.css') }}">
@endsection

@section('content')
<div class="rating__content">
    <div class="rating__shop">
        <div class="rating__shop--text">
            <p class="question">今回のご利用はいかがでしたか？</p>
        </div>
        <div class="rating__shop--card">
            <div class="card-img">
                <img class="shop-img" src="{{ asset($shop->shop_img) }}" alt="shop">
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
                    @csrf
                    <div class="review-read">
                        <button class="review-read-button" type="submit" name="review">★</button>
                    </div>
                </form>
                @if($shop->already_favorite())
                <div class="favorite">
                    <button class="favorite-button isActive" type="submit" name="favorite" data-shop-id="{{ $shop->id }}">❤</button>
                </div>
                @else
                <div class="favorite">
                    <button class="favorite-button notActive" type="submit" name="favorite" data-shop-id="{{ $shop->id }}">❤</button>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="rating__form">
        <div class="rating__form--content">
            @if (isset($rating))
            <form class="form" action="{{ route('edited', ['shop_id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
                @else
                <form class="form" action="{{ route('rated', ['shop_id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="rating">
                        <p class="rating-text">体験を評価してください</p>
                        <div class="rate-form">
                            @if (isset($rating->rating))
                            @if ($rating->rating == 5)
                            <input id="star5" type="radio" name="rating" value="5" checked>
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rating" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rating" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rating" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rating" value="1">
                            <label for="star1">★</label>
                            @elseif ($rating->rating == 4)
                            <input id="star5" type="radio" name="rating" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rating" value="4" checked>
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rating" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rating" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rating" value="1">
                            <label for="star1">★</label>
                            @elseif ($rating->rating == 3)
                            <input id="star5" type="radio" name="rating" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rating" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rating" value="3" checked>
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rating" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rating" value="1">
                            <label for="star1">★</label>
                            @elseif ($rating->rating == 2)
                            <input id="star5" type="radio" name="rating" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rating" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rating" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rating" value="2" checked>
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rating" value="1">
                            <label for="star1">★</label>
                            @elseif ($rating->rating == 1)
                            <input id="star5" type="radio" name="rating" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rating" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rating" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rating" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rating" value="1" checked>
                            <label for="star1">★</label>
                            @endif
                            @else
                            <input id="star5" type="radio" name="rating" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rating" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rating" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rating" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rating" value="1">
                            <label for="star1">★</label>
                            @endif
                        </div>
                        <div class="form__error">
                            @error('rating')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="rating-comment">
                        <p class="rating-text">口コミを投稿</p>
                        @if (isset($rating->text))
                        <textarea class="text" name="text" cols="71" rows="5" placeholder="カジュアルな夜のお出かけにおすすめのスポット" id="count">{{ $rating->text }}</textarea>
                        <div class="counter">
                            <span class="show-count">{{ mb_strlen($rating->text) }}</span>/400（最高文字数）
                        </div>
                        @else
                        <textarea class="text" name="text" cols="71" rows="5" placeholder="カジュアルな夜のお出かけにおすすめのスポット" id="count"></textarea>
                        <div class="counter">
                            <span class="show-count">0</span>/400（最高文字数）
                        </div>
                        @endif
                        <div class="form__error">
                            @error('text')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="rating-image">
                        <p class="rating-text">画像の追加</p>
                        <div class="upload-zone">
                            @if (isset($rating->image))
                            <input class="image-wrapper" type="file" name="image" id='image' , accept="image/jpeg,image/png">
                            <p class="click-text">クリックして画像を追加</p>
                            <p class="drag-text">またはドラッグアンドドロップ</p>
                            <div class="preview">
                                <img src="{{ asset($rating->image) }}" alt="image">
                            </div>
                            <script>
                                const fileInput = document.querySelector('input[type="file"]');
                                const myFile = new File(['image'], '! 再度画像をアップロードし直してください', {
                                    type: 'image',
                                    lastModified: new Date(),
                                });
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(myFile);
                                fileInput.files = dataTransfer.files;
                            </script>
                            @else
                            <input class="image-wrapper" type="file" name="image" accept=".jpeg,.png">
                            <p class="click-text">クリックして画像を追加</p>
                            <p class="drag-text">またはドラッグアンドドロップ</p>
                            <div class="preview"></div>
                            @endif
                            <div class=" form__error">
                                @error('image')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if (isset($rating))
                    <div class="rating__form-button">
                        <button class="rating-button" type="submit">口コミを編集
                        </button>
                    </div>
                    @else
                    <div class="rating__form-button">
                        <button class="rating-button" type="submit">口コミを投稿
                        </button>
                    </div>
                    @endif
                </form>
            </form>
        </div>
    </div>
</div>
@endsection