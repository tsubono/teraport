@extends('front.layouts.app')

@section('title', 'てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/top.css') }}">
@endsection

@section('content')
    <!-- 未ログインの場合 -->
    @if (!auth()->check())
        <!-- ページトップ -->
        <section class="top-catch">
            <div class="container">
                <div class="top-txt">
                    <p>あなたのニーズにあったお寺・お坊さんに出会えます！</p>
                </div>
                <div class="middle-txt">
                    <p>あなたとお寺・お坊さんを直接つなぐ<br>マッチングサービス</p>
                </div>
                <div class="bottom-txt">
                    <ul>
                        <li><span>葬儀や法事を依頼したいけど相談できるお寺・お坊さんがいない・・・</span></li>
                        <li><span>お墓や納骨について安心して相談できるお寺・お坊さんを探している・・・</span></li>
                        <li><span>人生・仕事の悩みごとについてお坊さんに相談してみたい・・・</span></li>
                    </ul>
                </div>
                <div class="left-img">
                    <img src="{{ secure_asset('img/mark1.png') }}" alt="マーク">
                </div>
                <div class="right-img">
                    <img src="{{ secure_asset('img/mark2.png') }}" alt="マーク">
                </div>
            </div>
        </section>

        <!-- バナー -->
        <div class="register-login-banner">
            <div class="top-txt">
                <p>＼ 登録無料 ／</p>
            </div>
            <div class="middle-txt">
                <p>いますぐお坊さんを探してみる</p>
            </div>
            <div class="bottom-btn">
                <div class="left-register">
                    <p><a href="{{ route('register') }}">新規会員登録</a></p>
                </div>
                <div class="right-login">
                    <p><a href="{{ route('login') }}">ログイン</a></p>
                </div>
            </div>
        </div>
    @endif

    <!-- カテゴリ -->
    <section class="by-category">
        <div class="container">
            <h2>カテゴリからサービスを探す</h2>
            <div class="categories">
                @foreach ($categories as $category)
                    <a href="{{ route('front.services.index') }}?c={{ $category->id }}">
                        <div class="category">
                            <div class="left-icon">
                                <img src="{{ $category->icon_path }}" alt="アイコン">
                            </div>
                            <div class="right-txt">
                                <p>　{{ $category->name }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- サービス一覧 -->
    <section class="service-list">
        <h2>新着サービス一覧</h2>
        <div class="container">
            <div class="service-items">
                @foreach($services as $service)
                    <a href="{{ route('front.services.show', ['service' => $service]) }}">
                        <div class="service-item">
                            <div class="top-img">
                                <img class="service-image" src="{{ $service->eye_catch_image_path }}" alt="サービス">
                            </div>
                            <div class="category-tag">
                                <p>{{ $service->category->name }}</p>
                            </div>
                            <div class="main-txt">
                                <p>{{ $service->title }}</p>
                            </div>
                            <div class="price">
                                <p><span>お布施</span>¥{{ number_format($service->price) }}</p>
                            </div>
                            <div class="person-info">
                                <div class="left-img">
                                    <img class="user-image" src="{{ $service->user->display_icon_image_path }}" alt="顔写真">
                                </div>
                                <div class="fullname">
                                    <p>{{ $service->user->name }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="more-service">
            <a href="{{ route('front.services.index') }}">もっとサービスをみる</a>
        </div>
    </section>

    <!-- 未ログインの場合 -->
    @if (!auth()->check())
        <!-- バナー（ページ下） -->
        <div class="register-login-banner">
            <div class="top-txt">
                <p>＼ 登録無料 ／</p>
            </div>
            <div class="middle-txt">
                <p>いますぐお坊さんを探してみる</p>
            </div>
            <div class="bottom-btn">
                <div class="left-register">
                    <p><a href="{{ route('register') }}">新規会員登録</a></p>
                </div>
                <div class="right-login">
                    <p><a href="{{ route('login') }}">ログイン</a></p>
                </div>
            </div>
        </div>
    @endif
@endsection
