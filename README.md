# カレンダーサイト

## 概要
このカレンダーサイトは、ユーザーがイベントを簡単に追加、表示、管理できるウェブアプリケーションです。Vue.jsとFullCalendarを使用して開発され、現代のウェブ技術を活用したスムーズで直感的なユーザー体験を提供します。

## 主な機能
- **イベントの追加**: ユーザーは特定の日付にイベントを追加できます。
- **イベントの編集と削除**: 登録されたイベントは、後から編集や削除が可能です。
- **イベントの閲覧**: 月間、週間、日別でイベントを閲覧できるカレンダービューを提供します。
- **動的なイベントデータの取得**: サーバーからのイベントデータを動的に取得し、カレンダーに表示します。

- 
## 機能紹介動画
https://github.com/suzu6331/calendar/assets/128467874/bf3675ec-63cb-47bf-b7c5-cfc602f5b09b

## 技術スタック
- **フロントエンド**: Vue.js
- **カレンダー表示**: FullCalendar
- **バックエンド**: Node.js (プロジェクトに応じて変更してください)
- **データベース**: MongoDB (プロジェクトに応じて変更してください)
- **その他の技術**: axiosでの非同期通信、クラウドサービス（AWS/GCP）

## セットアップ方法

### データベースの準備
1. **phpMyAdminへのアクセス**:
    - ブラウザで `http://localhost/phpmyadmin` にアクセスし、`root` ユーザーでパスワードなしでログインします。

2. **ユーザーとデータベースの作成**:
    - データベース名: `laravel`
    - ユーザ名: `laravel`
    - パスワード: 任意のもの

### Laravelプロジェクトのセットアップ
1. **.envファイルの編集**:
    ```
    DB_DATABASE=laravel
    DB_USERNAME=laravel
    DB_PASSWORD=任意のパスワード
    ```

2. **データベースマイグレーション**:
    ```
    php artisan migrate --seed
    ```

### バーチャルホストの設定（オプション）
- Apacheの`httpd-vhosts.conf`ファイルと`hosts`ファイルの編集を行います。

## 使用方法
プロジェクトをローカルで起動した後、ブラウザを開いて `http://localhost:8080` にアクセスすると、カレンダーサイトを利用できます。

