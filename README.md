2024/3/19更新(3つの追加機能について追記いたしました)<br>
2024/2/26新規作成<br>
<br>

# アプリケーション名
Rese（飲食店予約サービス）

## 作成した目的
Proテスト提出用
上級模擬案件提出用
 
## アプリケーションURL
http://localhost/login<br>
<br>
※本人認証メールとリマインダーはmailhogに送信されます。<br>
http://localhost:8025<br>
<br>
※PhpMyAdmin<br>
http://localhost:8080/

## 他のリポジトリ  
無し

## 機能一覧
**基本機能**<br>
・会員登録<br>
・ログイン<br>
・ログアウト<br>
・ユーザー情報取得<br>
・ユーザー飲食店お気に入り一覧取得<br>
・ユーザー飲食店予約情報取得<br>
・飲食店一覧取得<br>
・飲食店詳細取得<br>
・飲食店お気に入り追加<br>
・飲食店お気に入り削除<br>
・飲食店予約情報追加<br>
・飲食店予約情報削除<br>
・エリアで検索する<br>
・ジャンルで検索する<br>
・店名で検索する<br>
<br>
**追加実装機能**<br>
・飲食店予約情報変更<br>
・飲食店評価<br>
・飲食店評価閲覧<br>
・バリデーション(認証／予約)<br>
・店舗代表者作成<br>
・飲食店情報作成<br>
・飲食店情報更新<br>
・飲食店予約情報確認<br>
・飲食店画像のストレージ保存<br>
・メール認証<br>
・予約当日リマインダー送信<br>
<br>
**Proテスト用の追加実装機能**<br>
・口コミ機能<br>
・店舗一覧ソート機能<br>
・csvインポート機能<br>

  
## 使用技術（実行環境）
OS：Linux（Ubuntu）<br>
環境：Docker Desktop v4.23.0<br>
言語：PHP 8.1.0（7.4.9からアップデート）、JQuery 3.7.1<br>
フレームワーク：Laravel 8<br>
DB：mysql 8.0.26<br>
WEBサーバソフトウェア：nginx 1.21.1<br>
エディタ：VSCode 1.84.0<br>

## テーブル設計
![Screenshot 2024-02-25 162506](https://github.com/tmdressage/rese/assets/144135026/fb94475d-a6c0-4924-be76-750530ec31f8)

## ER図
![Screenshot 2024-02-25 141811](https://github.com/tmdressage/rese/assets/144135026/46ee270d-2ae7-49af-96cd-5f8f414e2b5f)<br>
※中間テーブルの名称につきましては、担当コーチに相談のもと上記の名称で作成しております。

## 環境構築
**1、リポジトリの設定**<br>
※自身でGitHubに開発履歴を残さない場合は、下記の工程⓵のみ行います。<br>
<br>
<br>
⓵開発環境をGitHub からクローンする<br>
※~/coachtechディレクトリ配下のlaravelディレクトリで作業を行う場合を想定して記載します。<br>
```
コマンドライン上
$ cd coachtech/laravel
$ git clone git@github.com:tmdressage/rese.git
$ mv rese 任意のディレクトリ名
```

<br>
⓶GitHubでリモートリポジトリをpublicで作成する<br>
※リポジトリ名は前項で作成した任意のディレクトリ名を使用します。<br>

<br>
<br>
⓷リポジトリの紐付け先を変更する<br>

```
コマンドライン上
$ cd ⓵で作成したディレクトリ名
$ git remote set-url origin ⓶で作成したリモートリポジトリのSSHのurl
$ git remote -v
```

<br>
⓸ローカルリポジトリにあるデータを⓶で作成したリモートリポジトリに反映させる<br>

```
コマンドライン上
$ git add .
$ git commit -m "リモートリポジトリの変更"
$ git push origin main
```
<br>

**2、Dockerの設定**<br>
<br>
⓵Dockerの環境を構築する<br>

```
コマンドライン上
$ cd 工程1‐⓵で作成した任意のディレクトリ名
$ docker-compose up -d --build
```
※Docker Desktopでディレクトリ名のコンテナが作成され、起動していれば成功です。
<br>
<br>

**3、Laravelの設定**<br>
<br>
⓵Laravel のパッケージをインストールする<br>
```
コマンドライン上
$ docker-compose exec php bash
```
```
※PHPコンテナ上
$ composer install
$ exit
```
<br>

**4、.envファイルの作成**<br>
<br>
⓵.env.exampleファイルをコピーして作成する<br>
```
コマンドライン上
$ cd src/
$ cp .env.example .env
```
<br>
⓶以下のコードを.envファイルに上書きで貼り付ける<br>
※変更箇所はDBとメールの箇所です。

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mail
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="admin@rese.com"
MAIL_FROM_NAME="Rese"

WWWGROUP=1000
WWWUSER=1000

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

<br>
⓷以下のコードでAPP_KEYをセットする<br>

```
コマンドライン上
$ docker-compose exec php bash
```
```
※PHPコンテナ上
$ php artisan key:generate
```
<br>
<br>

**5、テーブルの作成**<br>
<br>
⓵下記コマンドでマイグレーションを行う<br>
```
※PHPコンテナ上
$ php artisan migrate
```

※http://localhost:8080/ を開いてテーブルが作成出来ていれば成功です。
<br>
<br>

**6、シーディング**<br>
<br>
⓵下記コマンドで初期ダミーデータを作成する<br>
```
※PHPコンテナ上
$ php artisan db:seed
```

※シーディングで各テーブル(ユーザ・飲食店情報・お気に入り・予約情報・飲食店評価)のデータを作成出来ます。<br>
　便宜上、管理者ユーザ・店舗代表者ユーザ・飲食店情報には固定のデータをDBに格納しております。<br>
※http://localhost:8080/ を開いてテーブルにデータが格納されていれば成功です。<br>
<br>
<br>

**7、シンボリックリンクの作成**<br>
<br>
⓵下記コマンドでシンボリックリンクを作成する<br>
```
※PHPコンテナ上
$ php artisan storage:link
$ exit
```

※飲食店情報の新規作成時に、アップロードした画像を表示させるために行います。
<br>
<br>

**8、クーロンの設定**<br>
<br>
⓵下記コマンドでクーロンを作成する<br>
```
※コマンドライン上
$ crontab -e
※クーロン設定画面に遷移
$ i
※insertモードに移行
$ * * * * * cd [プロジェクトのパス] && php artisan schedule:run >> /dev/null 2>&1
※escボタンでinsertモードを閉じる
$ :wq!
※上書き保存してクーロン設定画面から抜ける
$ crontab -l
※クーロン設定の一覧画面に遷移
$ :q!
※正しく登録できていればクーロン設定の一覧画面から抜ける
```

※リマインダーメールの送信の際に必要となります。
<br>
<br>
<br>
<br>
以上でございます。<br>
尚、アプリケーションにログインする際に<br>
「The stream or file "storage/logs/laravel.log" could not be opened: failed to open stream: <br>
Permission denied」<br>
の権限エラーが生じた場合は、コマンドラインでsrc/storageまで移動して「chmod -R 777 .」を打つと解消します。<br>
<br>

## その他
以下、補足事項でございます。<br>
<br>
・ログインをしていない状態では、お気に入り登録・評価閲覧、飲食店予約が出来ない仕様にして<br>
　おります(各々クリックするとログイン画面へ飛びます)。<br> 
・認証機能の作成にあたり、参考のためFortifyとLaravel Breezeをインストールしておりますが、<br>
　基本は使用せずに自作いたしました。<br>
<br>
<br>
<br>
## Proテスト用の3つの追加実装機能について

**口コミ機能**<br>
<br>
※上級模擬案件の追加実装項目(飲食店評価機能)とは別で、新たに作成しております。<br>
　飲食店カードの★マークは無視していただけますと幸いです。
<br>
⇒一般ユーザで飲食店詳細ページの左下部にある【口コミを投稿する】をクリックいただくと、<br>
　口コミ投稿ページに遷移いたします。<br> 
※管理者ユーザの場合は【全ての口コミ情報】のみ表示され(口コミ一覧から口コミを削除する用)、<br>
　店舗代表者ユーザには何も表示されない仕様となっております。
<br>
<br>
**店舗一覧ソート機能**<br>
<br>
⇒一般ユーザの飲食店一覧ページのヘッダに並び替え機能を実装いたしました。<br>
　エリアやジャンル検索、ワード検索と連動しております。<br> 
<br>
<br>
**csvインポート機能**<br>
<br>
⇒管理者ユーザのCsvImportを開くとcsvインポート画面に遷移いたします。<br>
　csvファイルの記述方法は以下の通りです。<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
## 追加実装機能について
<br>
**・飲食店予約情報変更**<br>
⇒マイページの予約情報欄の右上に表示される、開いた本のアイコンをクリックいただくと、<br>
　飲食店予約情報変更ページに遷移いたします。<br>
<br>
![Screenshot 2024-02-25 153817](https://github.com/tmdressage/rese/assets/144135026/81b0f23f-d187-412b-9011-3dee73f01a97)<br>
<br>
<br>
<br>
**・飲食店評価**<br>
⇒マイページの予約情報欄(過去日時の予約)の右上に表示される、星のアイコンをクリックいただくと、<br>
　飲食店評価ページに遷移いたします。<br> 
<br>
![Screenshot 2024-02-25 154146](https://github.com/tmdressage/rese/assets/144135026/c82de71b-9fb5-4a90-b1af-719bd6378764)<br>
<br>
<br>
<br>
**・飲食店評価閲覧**<br>
⇒マイページ、または飲食店一覧画面の飲食店カードの右下に表示される、星のアイコンをクリックいただくと、<br>
　飲食店評価閲覧ページに遷移いたします。<br>
<br>
![Screenshot 2024-02-25 154240](https://github.com/tmdressage/rese/assets/144135026/4892b818-fb59-4ff0-8803-6b86f80c5010)<br>
<br>
<br>
<br>
**・バリデーション**<br>
⇒ログイン時・会員登録時・飲食店予約時・飲食店予約変更時、飲食店評価時、店舗代表者作成時、<br>
　飲食店情報作成時において、各々バリデーションを作成いたしました。<br>
<br>
<br>
<br>
**・店舗代表者作成** <br> 
⇒システム管理者ユーザでログインいただくと、店舗代表者作成ページに遷移いたします。<br>
　メールアドレス：admin@example.co.jp<br>
　パスワード：PasswordPassword<br>
<br>
![Screenshot 2024-02-25 155332](https://github.com/tmdressage/rese/assets/144135026/1986e2ef-6975-41cb-85ca-876fa163b4d8)<br> 
<br>
<br>
<br>
**・飲食店情報作成**<br>
⇒作成した店舗代表者ユーザでログインいただくと、飲食店情報作成ページに遷移いたします。<br>
　(初回ログイン時はメール認証から始まります)<br>
<br>
![Screenshot 2024-02-25 155838](https://github.com/tmdressage/rese/assets/144135026/46fc64b0-b4d7-4376-9017-2ff8d7cbb0cf)<br>
<br>
<br>
<br>
**・飲食店情報更新**<br>
⇒新規で店舗情報を登録いただいた後は、同じフォームから上書き更新が出来ます。<br>
<br>
![Screenshot 2024-02-25 160415](https://github.com/tmdressage/rese/assets/144135026/058051d4-4765-4b35-8c87-a7a2d1f252d8)<br>
<br>
<br>
<br>
**・飲食店予約情報確認**<br>
⇒店舗代表者ユーザで、ハンバーガーメニューのReservation Statusをクリックいただくと、<br>
　飲食店予約情報確認ページに遷移いたします。<br>
　まだ飲食店情報を登録していない場合は、飲食店情報登録画面へと飛ぶ仕様です。<br>
<br>
![Screenshot 2024-02-25 160447](https://github.com/tmdressage/rese/assets/144135026/e1e2053d-d2bc-4438-bec0-2b9e7985c750)<br>
<br>
<br>
<br>
**・飲食店画像のストレージ保存**<br>
⇒飲食店情報作成時に、画像をアップロードいただくと、storage/app/public/img配下に画像が保存され、<br>
　DBにパスが格納されます。<br>
　シンボリックリンクにより、出力時はパスを参照して保存した画像が表示されます。<br>
<br>
![Screenshot 2024-02-25 160830](https://github.com/tmdressage/rese/assets/144135026/627ee2b0-f00d-42ca-9119-46fab20a02cc)<br>
<br>
![Screenshot 2024-02-25 161043](https://github.com/tmdressage/rese/assets/144135026/25590e05-c9c7-425d-a671-f415e8f4403e)<br>
<br>
<br>
<br>
**・メール認証**<br>
⇒メールの送信先は、開発用のメールサーバmailhogを使用しております。<br>
　送信ボタンをクリックすると本人確認メールがmailhogに送信されます。<br>
　http://localhost:8025<br>
<br>
![Screenshot 2024-02-25 143204](https://github.com/tmdressage/rese/assets/144135026/e37fe2b9-8321-4d51-8920-5172044e6dee)<br>
<br>
![Screenshot 2024-02-25 143344](https://github.com/tmdressage/rese/assets/144135026/c6fd0aa2-fed3-4067-9208-e6fc641e2879)<br>
<br>
<br>
<br>
**・予約当日リマインダー送信**<br>
⇒メールの送信先は、開発用のメールサーバmailhogを使用しております。<br>
　app/Console/Commands/Batch.phpで予約日が当日のレコードを持つユーザ情報を抽出し、<br>
　cronの設定とapp/Console/Kernel.phpで該当ユーザ宛に予約当日の朝8:00にリマインダーが<br>
　送信されるように設定しております。<br>
　http://localhost:8025<br>
<br>
![Screenshot 2024-02-25 161546](https://github.com/tmdressage/rese/assets/144135026/c2ffd1f1-ce94-4fbb-9282-9d83c671f02f)<br>
<br>
![Screenshot 2024-02-25 161828](https://github.com/tmdressage/rese/assets/144135026/4c235f75-2145-47f1-9577-b9c6779a6c23)<br>
<br>
<br>
<br>
※その他の追加実装項目（レスポンシブデザイン、お知らせメール送信、QRコード、決済機能、AWS、<br>
　環境の切り分け）は未実装です。
<br>
<br>
<br>
以上でございます。<br>
拙い点が多々ございますが、ご採点の程よろしくお願い申し上げます。<br>
