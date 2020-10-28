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
                            <label for="price">アイコン画像</label>
                            <drop-image v-bind:name="'icon_image_path'" v-bind:path="'{{ old('icon_image_path', auth()->user()->display_icon_image_path) }}'"
                                        v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded_images/user'"></drop-image>
                        </div>

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
                            <label for="job">職業</label>
                            <input id="job" type="text" name="job" value="{{ old('job', auth()->user()->job) }}">

                            @error('job')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">性別</label>
                            <label for="gender-1">
                                <input type="radio" id="gender-1" name="gender" value="男性" {{ old('gender', auth()->user()->gender) === '男性' ? 'checked' : '' }}>
                                男性
                            </label>
                            <label for="gender-2">
                                <input type="radio" id="gender-2" name="gender" value="女性" {{ old('gender', auth()->user()->gender) === '女性' ? 'checked' : '' }}>
                                女性
                            </label>

                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="area">活動エリア</label>
                            <input id="area" type="text" name="area" value="{{ old('area', auth()->user()->area) }}">

                            @error('area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                            <p class="text-small">更新する場合のみご入力ください</p>

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
