@extends('front.layouts.app')

@section('title', 'お問い合わせ | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/contact.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="contact">
            <div class="container">
                <h2>お問い合わせ送信</h2>

                @if (!auth()->check())
                    <div class="register-caution">
                        <div class="caution">※ お問い合わせの送信には会員登録が必要です</div>
                        <a class="submit-btn" href="{{ route('register') }}">会員登録</a>
                    </div>
                @else
                    <div class="form-content contact-form">
                        <form action="{{ route('front.contact.send') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">お名前</label>
                                <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}">

                                @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="type">ユーザー種別</label>
                                <label for="type-1">
                                    <input type="radio" id="type-1" name="type" value="僧侶" {{ old('type') === '僧侶' ? 'checked' : '' }}>
                                    僧侶
                                </label>
                                <label for="type-2">
                                    <input type="radio" id="type-2" name="type" value="一般ユーザー" {{ old('type') === '一般ユーザー' ? 'checked' : '' }}>
                                    一般ユーザー
                                </label>

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">メールアドレス</label>
                                <input id="email" type="text" name="email" value="{{ old('email', auth()->user()->email) }}">

                                @error('email')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="content">問い合わせ内容</label>
                                <textarea name="content" rows="10">{{ old('content') }}</textarea>

                                @error('content')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="submit-btn">
                                    送信する
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
