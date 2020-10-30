## てらぽーとWebアプリ用リポジトリ

### 技術
**Laravel 7.28.4**
  - PHP7
  - HTML / CSS
  - Vue.js / jQuery

### 最初だけ実行必要なコマンド
```
$ cp .env.example .env
// .envを自分の環境に編集
$ composer install
$ npm install
$ npm run dev
$ php artisan key:generate
$ php artisan migrate --seed
$ php artisan storage:link
```

※ 決済にStripeを使用しているので、.envにキーの設定が必要です <br>
```
STRIPE_PUBLIC_KEY=
STRIPE_SECRET_KEY=
```
不明な場合は問い合わせください。
<br>

### 備考
コンパイルで出力される
```
- public/js/*
- public/css/*
```
は.gitignoreに指定しています。<br>
もしコンパイル以外でjs・cssファイルを追加したい場合は、<br>
public/asset/以下に配置してください。
