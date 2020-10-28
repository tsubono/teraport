@extends('front.layouts.app')

@section('title', 'TOP | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
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
                    <p>あなたとお寺・お坊さんを直接つなぐ<br>
                        新しいサービス</p>
                </div>
                <div class="bottom-txt">
                    <ul>
                        <li><span>葬儀や法事を依頼したいけど相談できるお寺・お坊さんがいない・・・</span></li>
                        <li><span>お墓や納骨について安心して相談できるお寺・お坊さんを探している・・・</span></li>
                        <li><span>人生・仕事の悩みごとについてお坊さんに相談してみたい・・・</span></li>
                    </ul>
                </div>
                <div class="left-img">
                    <img src="../img/mark1.png" alt="マーク">
                </div>
                <div class="right-img">
                    <img src="../img/mark2.png" alt="マーク">
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
                    <div class="category" onclick="location.href='{{ route('front.services.index') }}?c={{ $category->id }}'">
                        <div class="left-icon">
                            <img src="{{ $category->icon_path }}" alt="アイコン">
                        </div>
                        <div class="right-txt">
                            <p>　{{ $category->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- サービス一覧 -->
    <section class="service-list">
        <h2>新着サービス一覧</h2>
        <div class="container">
            <div class="service-items">
                <div class="service-item">
                    <div class="top-img">
                        <img src="../img/service1.png" alt="サービス">
                    </div>
                    <div class="category-tag">
                        <p>人生・悩み・開運相談</p>
                    </div>
                    <div class="main-txt">
                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                    </div>
                    <div class="price">
                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                    </div>
                    <div class="person-info">
                        <div class="left-img">
                            <img src="../img/face1.png" alt="顔写真">
                        </div>
                        <div class="fullname">
                            <p>山田 太郎</p>
                        </div>
                    </div>
                </div>

                <div class="service-item">
                    <div class="top-img">
                        <img src="../img/service2.png" alt="サービス">
                    </div>
                    <div class="category-tag">
                        <p>人生・悩み・開運相談</p>
                    </div>
                    <div class="main-txt">
                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                    </div>
                    <div class="price">
                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                    </div>
                    <div class="person-info">
                        <div class="left-img">
                            <img src="../img/face2.png" alt="顔写真">
                        </div>
                        <div class="fullname">
                            <p>山田 太郎</p>
                        </div>
                    </div>
                </div>

                <div class="service-item">
                    <div class="top-img">
                        <img src="../img/service3.png" alt="サービス">
                    </div>
                    <div class="category-tag">
                        <p>人生・悩み・開運相談</p>
                    </div>
                    <div class="main-txt">
                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                    </div>
                    <div class="price">
                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                    </div>
                    <div class="person-info">
                        <div class="left-img">
                            <img src="../img/face3.png" alt="顔写真">
                        </div>
                        <div class="fullname">
                            <p>山田 太郎</p>
                        </div>
                    </div>
                </div>

                <div class="service-item">
                    <div class="top-img">
                        <img src="../img/service4.png" alt="サービス">
                    </div>
                    <div class="category-tag">
                        <p>人生・悩み・開運相談</p>
                    </div>
                    <div class="main-txt">
                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                    </div>
                    <div class="price">
                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                    </div>
                    <div class="person-info">
                        <div class="left-img">
                            <img src="../img/face5.png" alt="顔写真">
                        </div>
                        <div class="fullname">
                            <p>山田 太郎</p>
                        </div>
                    </div>
                </div>

                <div class="service-item">
                    <div class="top-img">
                        <img src="../img/service5.png" alt="サービス">
                    </div>
                    <div class="category-tag">
                        <p>人生・悩み・開運相談</p>
                    </div>
                    <div class="main-txt">
                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                    </div>
                    <div class="price">
                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                    </div>
                    <div class="person-info">
                        <div class="left-img">
                            <img src="../img/face6.png" alt="顔写真">
                        </div>
                        <div class="fullname">
                            <p>山田 太郎</p>
                        </div>
                    </div>
                </div>

                <div class="service-item">
                    <div class="top-img">
                        <img src="../img/service6.png" alt="サービス">
                    </div>
                    <div class="category-tag">
                        <p>人生・悩み・開運相談</p>
                    </div>
                    <div class="main-txt">
                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                    </div>
                    <div class="price">
                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                    </div>
                    <div class="person-info">
                        <div class="left-img">
                            <img src="../img/face1.png" alt="顔写真">
                        </div>
                        <div class="fullname">
                            <p>山田 太郎</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-service" onclick="location.href='{{ route('front.services.index') }}'">
            <p>もっとサービスをみる</p>
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
