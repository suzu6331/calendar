# カレンダーサイト

## 概要
このカレンダーサイトは、ユーザーがイベントを簡単に追加、表示、管理できるウェブアプリケーションです。主にLaravelとFullCalendarを使用して開発しています。

## 作成するきっかけ
- スマホで使っていたカレンダーアプリがPC版だと非常に見にくかったので自分で見やすいものを作りたいと思った
- これまで個人で開発したことなかったので経験としてやってみたかった
- 作成時授業でPHPとJavascriptを触っていたのでその知識を深めたかった

## 主な機能
- **イベントの追加**: 特定の日付にイベントを追加できます。
- **イベントの編集と削除**: 登録されたイベントは、後から編集や削除が可能です。
- **イベントの閲覧**: 月間、週間、日別でイベントを閲覧できるカレンダービューを提供します。
- **動的なイベントデータの取得**: サーバーからのイベントデータを動的に取得し、カレンダーに表示します。

- 
## 機能紹介動画
https://github.com/suzu6331/calendar/assets/128467874/bf3675ec-63cb-47bf-b7c5-cfc602f5b09b

## 技術スタック
- **フロントエンド**: HTML/CSS
- **バックエンド**: Javascript、PHP
- **フレームワーク**: Laravel、Vue.js、FullCalendar
- **データベース**: Mysql
- **その他の技術**: axiosでの非同期通信、AWS（授業で一時的に使用）

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

## テーブルについて
- users
　グループウェアを利用するメンバーの情報（ログインに使用）
- events
　イベント情報を登録
- event_members
　イベント情報登録時に通知されるメンバー（イベント上にも参加者として表示）

## 使用方法
プロジェクトをローカルで起動した後、ブラウザを開いて `http://localhost:8080` にアクセスすると、カレンダーサイトを利用できます。

