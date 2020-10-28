@extends('front.layouts.app')

@section('title', 'サービス一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <!-- プロフィール -->
        <section class="user-profile-edit">
            <div class="container">
                <h2>プロフィール編集</h2>

                <div class="form-content">
                    <form method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                        <div class="form-group">
                            <label for="name">お名前</label>
                            <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="introduction">自己紹介</label>
                            <textarea name="introduction" rows="10">{{ old('introduction', auth()->user()->introduction) }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="text" name="email" value="{{ old('email', auth()->user()->email) }}">

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

                        <div class="form-footer">
                            <button type="submit" class="submit-btn register-btn">
                                更新する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
