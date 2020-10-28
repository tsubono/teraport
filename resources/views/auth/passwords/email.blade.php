@extends('front.layouts.app')

@section('title', 'パスワードをお忘れの方 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section>
            <div class="container">
                <h2>パスワードをお忘れの方</h2>
                @if (session('status'))
                    <div class="text-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-content auth-form">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email"
                                   autofocus>

                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="submit-btn">
                                パスワード再設定メールを送信する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
