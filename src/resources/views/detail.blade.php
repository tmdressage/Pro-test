@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
    <div class="detail__shop">
        <div class="detail__shop-name">
            <a class="back-button" href="/">＜</a>
            <div class="shop-name">
                {{ $shop->shop_name }}
            </div>
        </div>
        <div class="detail__shop-img">
            <img class="shop-img" src="{{ asset($shop->shop_img) }}" alt="shop">
        </div>
        <div class="detail__shop-tag">
            <p class="shop-area">#{{ $shop->shop_area }}</p>
            <p class="shop-genre">#{{ $shop->shop_genre }}</p>
        </div>
        <h3 class="detail__shop-text">#{{ $shop->shop_text }}</h3>
        @if (Auth::check())
        @can('user')
        @if (isset($rating))
        <div class="detail__shop-rating">
            <form action="{{ route('rating_all', ['shop_id' => $shop->id]) }}" method="get">
                @csrf
                <input class="detail__shop-rating--all" type="submit" value="全ての口コミ情報">
            </form>
            <div class="detail__shop-rating--posted">
                <div class="detail__shop-rating--edit">
                    <form action="{{ route('edit', ['shop_id' => $shop->id]) }}" method="get">
                        @csrf
                        <input class="detail__shop-rating--change" type="submit" value="口コミを編集">
                    </form>
                    <form action="{{ route('delete', ['shop_id' => $shop->id]) }}" method="post">
                        @csrf
                        <input class="detail__shop-rating--delete" type="submit" value="口コミを削除">
                    </form>
                </div>
                <div class="detail__shop-rating--view">
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
        </div>
        @else
        <form action="{{ route('rating', ['shop_id' => $shop->id]) }}" method="get">
            @csrf
            <input class="detail__shop-rating--post" type="submit" value="口コミを投稿する">
        </form>
        @endif
        @elsecan('admin')
        <form action="{{ route('rating_all', ['shop_id' => $shop->id]) }}" method="get">
            @csrf
            <input class="detail__shop-rating--all" type="submit" value="全ての口コミ情報">
        </form>
        @endcan
        @endif
    </div>
    <div class="detail__reservation">
        <div class="detail__reservation--content">
            <div class="title">
                <p>予約</P>
            </div>
            <form class="reservation" action="{{ route('reservation', ['shop_id' => $shop->id]) }}" method="post">
                @csrf
                <input class="input-date" type="date" id="input-date" name="reserve_date">
                <div class="form__error">
                    @error('reserve_date')
                    {{ $message }}
                    @enderror
                </div>
                <div class="select-time">
                    <select class="input-time" id="input-time" name="reserve_time">
                        <option value="" disabled selected style="display:none;">- - : - -</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="12:00">12:00</option>
                        <option value="12:30">12:30</option>
                        <option value="13:00">13:00</option>
                        <option value="13:30">13:30</option>
                        <option value="14:00">14:00</option>
                        <option value="14:30">14:30</option>
                        <option value="15:00">15:00</option>
                        <option value="15:30">15:30</option>
                        <option value="16:00">16:00</option>
                        <option value="16:30">16:30</option>
                        <option value="17:00">17:00</option>
                        <option value="17:30">17:30</option>
                        <option value="18:00">18:00</option>
                        <option value="18:30">18:30</option>
                        <option value="19:00">19:00</option>
                        <option value="19:30">19:30</option>
                        <option value="20:00">20:00</option>
                        <option value="20:30">20:30</option>
                        <option value="21:00">21:00</option>
                        <option value="21:30">21:30</option>
                        <option value="22:00">22:00</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('reserve_time')
                    {{ $message }}
                    @enderror
                </div>
                <div class="select-number">
                    <select class="input-number" id="input-number" name="reserve_number">
                        <option value="" disabled selected style="display:none;">- 人</option>
                        <option value="1">1人</option>
                        <option value="2">2人</option>
                        <option value="3">3人</option>
                        <option value="4">4人</option>
                        <option value="5">5人</option>
                        <option value="6">6人</option>
                        <option value="7">7人</option>
                        <option value="8">8人</option>
                        <option value="9">9人</option>
                        <option value="10">10人</option>
                        <option value="11">11人</option>
                        <option value="12">12人</option>
                        <option value="13">13人</option>
                        <option value="14">14人</option>
                        <option value="15">15人</option>
                        <option value="16">16人</option>
                        <option value="17">17人</option>
                        <option value="18">18人</option>
                        <option value="19">19人</option>
                        <option value="20">20人</option>
                        <option value="21">21人</option>
                        <option value="22">22人</option>
                        <option value="23">23人</option>
                        <option value="24">24人</option>
                        <option value="25">25人</option>
                        <option value="26">26人</option>
                        <option value="27">27人</option>
                        <option value="28">28人</option>
                        <option value="29">29人</option>
                        <option value="30">30人</option>
                        <option value="31">31人</option>
                        <option value="32">32人</option>
                        <option value="33">33人</option>
                        <option value="34">34人</option>
                        <option value="35">35人</option>
                        <option value="36">36人</option>
                        <option value="37">37人</option>
                        <option value="38">38人</option>
                        <option value="39">39人</option>
                        <option value="40">40人</option>
                        <option value="41">41人</option>
                        <option value="42">42人</option>
                        <option value="43">43人</option>
                        <option value="44">44人</option>
                        <option value="45">45人</option>
                        <option value="46">46人</option>
                        <option value="47">47人</option>
                        <option value="48">48人</option>
                        <option value="49">49人</option>
                        <option value="50">50人</option>
                        <option value="51">51人</option>
                        <option value="52">52人</option>
                        <option value="53">53人</option>
                        <option value="54">54人</option>
                        <option value="55">55人</option>
                        <option value="56">56人</option>
                        <option value="57">57人</option>
                        <option value="58">58人</option>
                        <option value="59">59人</option>
                        <option value="60">60人</option>
                        <option value="61">61人</option>
                        <option value="62">62人</option>
                        <option value="63">63人</option>
                        <option value="64">64人</option>
                        <option value="65">65人</option>
                        <option value="66">66人</option>
                        <option value="67">67人</option>
                        <option value="68">68人</option>
                        <option value="69">69人</option>
                        <option value="70">70人</option>
                        <option value="71">71人</option>
                        <option value="72">72人</option>
                        <option value="73">73人</option>
                        <option value="74">74人</option>
                        <option value="75">75人</option>
                        <option value="76">76人</option>
                        <option value="77">77人</option>
                        <option value="78">78人</option>
                        <option value="79">79人</option>
                        <option value="80">80人</option>
                        <option value="81">81人</option>
                        <option value="82">82人</option>
                        <option value="83">83人</option>
                        <option value="84">84人</option>
                        <option value="85">85人</option>
                        <option value="86">86人</option>
                        <option value="87">87人</option>
                        <option value="88">88人</option>
                        <option value="89">89人</option>
                        <option value="90">90人</option>
                        <option value="91">91人</option>
                        <option value="92">92人</option>
                        <option value="93">93人</option>
                        <option value="94">94人</option>
                        <option value="95">95人</option>
                        <option value="96">96人</option>
                        <option value="97">97人</option>
                        <option value="98">98人</option>
                        <option value="99">99人</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('reserve_number')
                    {{ $message }}
                    @enderror
                </div>
                <div class="reservation-output">
                    <table class="reservation-table">
                        <tr>
                            <td class="column-space">Shop</td>
                            <td class="column-space">{{ $shop->shop_name }}</td>
                        </tr>
                        <tr>
                            <td class="column-space">Date</td>
                            <td class="column-space"><span id="output-date"></span></td>
                        </tr>
                        <tr>
                            <td class="column-space">Time</td>
                            <td class="column-space"><span id="output-time"></span></td>
                        </tr>
                        <tr>
                            <td class="column-space">Number</td>
                            <td class="column-space"><span id="output-number"></span></td>
                        </tr>
                    </table>
                </div>
                @if (Auth::check())
                @can('user')
                <div class="detail__reservation-button">
                    <button class="reservation-button" type="submit">予約する
                    </button>
                </div>
                @endcan
                @canany(['admin','owner'])
                <div class="detail__reservation-button">
                    <p class="not-reservation-button">! このユーザ権限では予約機能を利用できません
                    </p>
                </div>
                @endcanany
                @else
                <div class="detail__reservation-button">
                    <button class="reservation-button" type="submit">予約する
                    </button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection