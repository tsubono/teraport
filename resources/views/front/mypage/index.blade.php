@extends('front.layouts.app')

@section('title', 'サービス一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <!-- プロフィール -->
        <section class="user-profile">
            <div class="container">
                <h3>プロフィール</h3>
                <div class="my-profile">
                    <div class="my-img">
                        <img class="user-image" src="{{ auth()->user()->display_icon_image_path }}" alt="アイコン">
                    </div>
                    <div class="my-info">
                        <div class="my-name">
                            <p>{{ auth()->user()->name }}</p>
                        </div>
                        <div class="txt">
                            {!! nl2br(e(auth()->user()->introduction)) !!}
                        </div>
                        <div class="my-status">
                            <p>性別：{{ auth()->user()->gender }}</p>
                            <p>職業：{{ auth()->user()->job }}</p>
                            <p>活動エリア：{{ auth()->user()->area }}</p>
                        </div>
                    </div>
                </div>
                <div class="edit-btn">
                    <p><a href="{{ route('front.mypage.profile') }}">プロフィールを編集する</a></p>
                </div>
                <div class="preview-btn">
                    <p><a href="{{ route('front.users.show', ['user' => auth()->user()]) }}" target="_blank">自分のページを確認</a></p>
                </div>
            </div>
        </section>

        <div class="customer-or-seller-menu">
            <div class="customer-menu">
                <p>
                    <a href="{{ route('front.mypage.index') }}?type=buyer" class="{{ $params['type'] === 'buyer' ? 'active' : '' }}">
                        購入者向けメニュー
                    </a>
                </p>
            </div>
            <div class="seller-menu">
                <p>
                    <a href="{{ route('front.mypage.index') }}?type=seller" class="{{ $params['type'] === 'seller' ? 'active' : '' }}">
                        出品者向けメニュー
                    </a>
                </p>
            </div>
        </div>

        <!-- 取引メッセージ -->
        <section class="deal-message">
            <div class="container">
                <h3>取引メッセージ</h3>
                <div class="deal-msgs">
                    @foreach($directMessageRooms as $room)
                        <div class="deal-msg">
                            <div class="dealer-info">
                                <div class="face-img">
                                    <img src="{{ $room->toUser->display_icon_image_path }}" alt="アイコン">
                                </div>
                                <div class="name">
                                    <p>{{ $room->toUser->name }}</p>
                                </div>
                            </div>
                            <div class="txt">
                                {{ Str::limit($room->firstMessage->content, 50) }}
                            </div>
                            <div class="check-message">
                                <p><a href="{{ route('front.direct-messages.show', ['room' => $room]) }}">メッセージを確認する</a></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="check-all-message">
                    <p><a href="{{ route('front.direct-messages.index') }}">すべてのメッセージを見る</a></p>
                </div>
            </div>
        </section>

    @if ($params['type'] === 'buyer')
        <!-- 購入サービス -->
            <section class="my-service-list">
                <div class="container">
                    <h3>購入サービス</h3>
                    <div class="my-services">
                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service1.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>決済金額　<span>¥12,500</span></p>
                                </div>
                            </div>
                            <div class="right-status">
                                <p><span>相談中</span></p>
                            </div>
                        </div>

                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service2.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>決済金額　<span>¥12,500</span></p>
                                </div>
                            </div>
                            <div class="right-status">
                                <p>解決済</p>
                            </div>
                        </div>

                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service3.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>決済金額　<span>¥12,500</span></p>
                                </div>
                            </div>
                            <div class="right-status">
                                <p>解決済</p>
                            </div>
                        </div>
                    </div>
                    <div class="check-shopping-list">
                        <p><a>購入履歴を確認する</a></p>
                    </div>
                </div>
            </section>
    @else
        <!-- 出品サービス -->
            <section class="my-service-list">
                <div class="container">
                    <h3>出品サービス</h3>
                    <div class="my-services">
                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service1.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>お布施目安　<span>¥10,000〜¥50,000</span></p>
                                </div>
                            </div>
                            <div class="right-status">
                                <p><span>出品中</span></p>
                            </div>
                        </div>

                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service7.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>お布施目安　<span>¥10,000〜¥50,000</span></p>
                                </div>
                            </div>
                            <div class="right-status">
                                <p>停止中</p>
                            </div>
                        </div>

                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service8.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>お布施目安　<span>¥10,000〜¥50,000</span></p>
                                </div>
                            </div>
                            <div class="right-status">
                                <p>停止中</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-page-btn">
                        <div class="check-shopping-list">
                            <p><a href="{{ route('front.mypage.services.index') }}">出品サービス管理へ</a></p>
                        </div>
                        <div class="sell-service-item">
                            <p><a href="{{ route('front.mypage.services.create') }}">新しくサービスを出品する</a></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 購入されたサービス -->
            <section class="my-service-list">
                <div class="container">
                    <h3>購入されたサービス（売上一覧）</h3>
                    <div class="my-services">
                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service1.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>決済金額　<span>¥12,500</span></p>
                                    <div class="customer-info">
                                        <p>購入者</p>
                                        <div class="customer-img">
                                            <img src="../img/face11.png" alt="顔写真">
                                        </div>
                                        <p>山田太郎</p>
                                    </div>
                                </div>
                            </div>
                            <div class="right-status">
                                <p><span>相談中</span></p>
                            </div>
                        </div>

                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service2.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>決済金額　<span>¥12,500</span></p>
                                    <div class="customer-info">
                                        <p>購入者</p>
                                        <div class="customer-img">
                                            <img src="../img/face11.png" alt="顔写真">
                                        </div>
                                        <p>山田太郎</p>
                                    </div>
                                </div>
                            </div>
                            <div class="right-status">
                                <p style="color: #008DEA">売上<br>申請中</p>
                            </div>
                        </div>

                        <div class="my-service">
                            <div class="left-img">
                                <img src="../img/service3.png" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>人生・悩み・開運相談</p>
                                </div>
                                <div class="txt">
                                    <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相談、な…</p>
                                </div>
                                <div class="price">
                                    <p>決済金額　<span>¥12,500</span></p>
                                    <div class="customer-info">
                                        <p>購入者</p>
                                        <div class="customer-img">
                                            <img src="../img/face11.png" alt="顔写真">
                                        </div>
                                        <p>山田太郎</p>
                                    </div>
                                </div>
                            </div>
                            <div class="right-status">
                                <p>解決済</p>
                            </div>
                        </div>
                    </div>
                    <div class="check-shopping-list">
                        <p><a>売上履歴を確認する</a></p>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
