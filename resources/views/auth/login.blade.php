@extends('front.layouts.app')

@section('title', 'ログイン | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section>
            <div class="container">
                <h2>ログイン</h2>
                <div class="form-content auth-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email"
                                   autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input id="password" type="password" name="password" value="{{ old('password') }}">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="label" for="remember">
                                    ログイン状態を保持する
                                </label>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="submit-btn">
                                ログイン
                            </button>
                            <div class="register-link">
                                <div class="default-btn">
                                    <a href="{{ route('register') }}">新規登録</a>
                                </div>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="password-link">
                                    <a href="{{ route('password.request') }}">
                                        パスワードを忘れた方はこちら
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
