@extends('front.layouts.app')

@section('title', '新規登録 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section>
            <div class="container">
                <h2>新規登録</h2>
                <div class="form-content auth-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">お名前</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="text" name="email" value="{{ old('email') }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input id="password" type="password" name="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="terms-area">
                            @include('auth._terms')
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="submit-btn register-btn">
                                利用規約に同意し会員登録をする
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
