<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DoneController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ReservationStatusController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewReadController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RatingAllController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

// ⓵メール認証関連のルート
Route::controller(EmailVerificationController::class)
    ->prefix('email')->name('verification.')->group(function () {
        Route::get('/verify', 'verify')->name('notice');
        Route::post('/notification', 'notification')
            ->middleware('throttle:6,1')->name('send');
        Route::get('/verification/{id}/{hash}', 'verification')
            ->middleware(['signed', 'throttle:6,1'])->name('verify');
    });

// ⓶ログイン(認証)後のルート
Route::middleware('web', 'verified', 'auth')->group(function () {

    // 飲食店一覧（ホーム）
    Route::get('/', [HomeController::class, 'getHome']);
    Route::get('/select', [HomeController::class, 'getSelect']);

    // ログアウト
    Route::get('/logout', [AuthController::class, 'getLogout']);

    // お気に入り登録
    Route::post('/favorite/:{shop_id}', [FavoriteController::class, 'postFavorite'])->name('favorite');

    // マイページ
    Route::get('/mypage', [MypageController::class, 'getMypage']);
    Route::post('/mypage/cancel/:{reservation_id}', [MypageController::class, 'postCancel'])->name('cancel');

    // 予約変更
    Route::get('/change/:{reservation_id}/:{shop_id}', [ChangeController::class, 'getChange'])->name('change');
    Route::post('/change/:{reservation_id}', [ChangeController::class, 'postChange'])->name('changed');

    // レビュー投稿
    Route::get('/review/:{reservation_id}/:{shop_id}', [ReviewController::class, 'getReview'])->name('review');
    Route::post('/review/:{shop_id}', [ReviewController::class, 'postReview'])->name('reviewed');

    // レビュー閲覧
    Route::get('/review/read/:{shop_id}', [ReviewReadController::class, 'getReviewRead'])->name('review_read');

    // 口コミ投稿・編集
    Route::get('/rating/:{shop_id}', [RatingController::class, 'getRating'])->name('rating');
    Route::get('/rating/edit/:{shop_id}', [RatingController::class, 'RatingEdit'])->name('edit');
    Route::post('/rating/:{shop_id}', [RatingController::class, 'postRating'])->name('rated');
    Route::post('/rating/edited/:{shop_id}', [RatingController::class, 'RatingEdited'])->name('edited');

    // 予約完了
    Route::get('/done', [DoneController::class, 'getDone']);
    Route::post('/done', [DoneController::class, 'postDone']);

    // 飲食店詳細
    Route::get('/detail/:{shop_id}', [DetailController::class, 'getDetail'])->name('detail');
    Route::post('/detail/reservation/:{shop_id}', [DetailController::class, 'postDetail'])->name('reservation');
    Route::post('/detail/delete/:{shop_id}', [DetailController::class, 'RatingDelete'])->name('delete');

    // 全ての口コミ画面
    Route::get('/rating/all/:{shop_id}', [RatingAllController::class, 'getRatingAll'])->name('rating_all');   
    Route::post('/rating/delete/:{shop_id}', [RatingAllController::class, 'postDelete'])->name('rating_delete');

    // 会員登録完了
    Route::get('/thanks', [AuthController::class, 'getThanks']);

    // 飲食店一覧(一旦ログアウトしてから)
    Route::get('/logout_getHome', [HomeController::class, 'logoutGetHome']);

    // 会員登録(一旦ログアウトしてから)
    Route::get('/logout_getRegister', [AuthController::class, 'logoutGetRegister']);
});

// ⓷ログイン(認証)後のルート：管理者用
Route::middleware('web', 'verified', 'auth', 'can:admin')->group(function () {

    // 店舗代表者登録
    Route::get('/admin', [AdminController::class, 'getAdmin']);
    Route::post('/admin/owner/register', [AdminController::class, 'postAdmin'])->name('owner_register');

    // CSVインポート
    Route::get('/import', [ImportController::class, 'getImport']);
    Route::post('/import/csv', [ImportController::class, 'postImport'])->name('import_csv');

    // 全ての口コミ画面（全ての口コミ削除）
    Route::post('/rating/admin/delete/:{rating_id}', [RatingAllController::class, 'postAdminDelete'])->name('admin_delete');
});

// ⓸ログイン(認証)後のルート：店舗代表者用
Route::middleware('web', 'verified', 'auth', 'can:owner')->group(function () {

    // 飲食店情報登録
    Route::get('/owner', [OwnerController::class, 'getOwner']);
    Route::post('/owner/shop/register', [OwnerController::class, 'postOwner'])->name('shop_register');

    // 予約状況確認
    Route::get('/reservation/status', [ReservationStatusController::class, 'getReservationStatus']);
});

// ⓹ログイン(認証)前のルート

// ログイン
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);

// 会員登録
Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/register', [AuthController::class, 'postRegister']);

// 飲食店一覧（ホーム）
Route::get('/', [HomeController::class, 'getHome']);
Route::get('/select', [HomeController::class, 'getSelect']);

// 飲食店詳細（閲覧）
Route::get('/detail/:{shop_id}', [DetailController::class, 'getDetail'])->name('detail');
