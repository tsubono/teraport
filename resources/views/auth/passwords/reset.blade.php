@extends('front.layouts.app')

@section('title', 'パスワード再設定 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section>
            <div class="container">
                <h2>パスワード再設定</h2>
                <div class="form-content auth-form">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="text" name="email" value="{{ $email ?? old('email') }}" autocomplete="email"
                                   autofocus>

                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input id="password" type="password" name="password">

                            @error('password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">パスワード (確認)</label>
                            <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="submit-btn">
                                パスワードを再設定する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
