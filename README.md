2024/3/19新規作成(3つの追加項目に関わる部分のみ抜粋いたします。)<br>

# アプリケーション名
Rese（飲食店予約サービス）

## 作成した目的
Proテスト提出用
 
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


## ER図

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
　飲食店カードの★アイコンは無視していただけますと幸いです。
<br>
<br>
⇒一般ユーザで飲食店詳細ページの左下部にある【口コミを投稿する】をクリックいただくと、<br>
　口コミ投稿ページに遷移いたします。<br> 
 <br>
⇒管理者ユーザの場合は【全ての口コミ情報】のみ表示され(口コミ一覧から口コミを削除する用)、<br>
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
以上でございます。<br>
拙い点が多々ございますが、ご採点の程よろしくお願い申し上げます。<br>
