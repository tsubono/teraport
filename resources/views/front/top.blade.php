@extends('front.layouts.app')

@section('title', 'てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/top.css') }}">
@endsection

@section('content')
    <!-- 未ログインの場合 -->
    @if (!auth()->check())
        <!-- バナー -->
        <div class="register-login-banner">
            <a class="contact-button" href="{{ route('front.contact.index') }}">
                <span>お問合せはこちら</span>
            </a>
            <div class="top-txt">
                <p>＼ 登録無料 ／</p>
            </div>
            <div class="middle-txt">
                <p>いますぐお坊さんを探してみる</p>
            </div>
            <div class="bottom-btn">
                <div class="left-register">
                    <p><a href="{{ route('register') }}">会員登録</a></p>
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
                                <p>{!! $category->name !!}</p>
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
                                <p>{{ str_replace('<br>', ' ', $service->category->name) }}</p>
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
            <a class="contact-button" href="{{ route('front.contact.index') }}">
                <span>お問合せはこちら</span>
            </a>
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
    @else
        <!-- バナー（ページ下） -->
        <div class="text-center mt-30">
            <a class="contact-button" href="{{ route('front.contact.index') }}">
                <span>お問合せはこちら</span>
            </a>
        </div>
    @endif
@endsection
