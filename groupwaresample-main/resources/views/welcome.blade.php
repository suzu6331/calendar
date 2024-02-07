@extends('layouts.common')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card border-primary mb-3">
                <h1 class="card-header text-center">
                    {{ config('app.name') }}
                </h1>
                <div class="card-body">
                    <form action="{{ route('auth.login') }}" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <span class="material-symbols-outlined">alternate_email</span>
                                メールアドレス
                            </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="メールアドレス">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <span class="material-symbols-outlined">lock</span>
                                パスワード
                            </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="パスワードを入力">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <span class="material-symbols-outlined">login</span>
                                ログイン
                            </button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
            <div class="card border-success mb-3">
                <div class="card-header">利用できるユーザー情報</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr class="text-center">
                            <th>メールアドレス</th>
                            <th>パスワード</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td><span class="" data-toggle="copy" data-text="{{ $user->email }}">{{ $user->email }}</span></td>
                                <td>password</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
