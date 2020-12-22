@extends('front.layouts.app')

@section('title', 'サービス一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/message.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/service.css') }}">
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
                <div class="profile-btn-area">
                    <a class="primary-btn" href="{{ route('front.mypage.profile') }}">プロフィールを編集する</a>
                    <a class="primary-btn white" href="{{ route('front.users.show', ['user' => auth()->user()]) }}" target="_blank">自分のページを確認</a>
                    @if (auth()->user()->is_admin)
                        <a class="primary-btn blue" href="{{ route('admin.sale-requests.index') }}">振り込み申請一覧</a>
                        <div class="admin-links">
                            <a href="{{ route('admin.users.index') }}">ユーザー管理</a>
                            <a href="{{ route('admin.services.index') }}">出品サービス管理</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <div class="customer-or-seller-menu">
            <div class="customer-menu">
                <p>
                    <a href="{{ route('front.mypage.index') }}?type=buyer" class="{{ $params['type'] === 'buyer' ? 'active' : '' }}">
                        利用者向けメニュー
                    </a>
                </p>
            </div>
            <div class="seller-menu">
                <p>
                    <a href="{{ route('front.mypage.index') }}?type=seller" class="{{ $params['type'] === 'seller' ? 'active' : '' }}">
                        提供者向けメニュー
                    </a>
                </p>
            </div>
        </div>

        <!-- 取引メッセージ -->
        <section class="deal-message">
            <div class="container">
                <h3>ダイレクトメッセージ</h3>
                <div class="deal-msgs">
                    @forelse($directMessageRooms as $room)
                        <div class="deal-msg">
                            <div class="dealer-info">
                                <div class="face-img">
                                    <img class="user-image" src="{{ $room->toUser->display_icon_image_path }}" alt="アイコン">
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
                    @empty
                        <p>まだメッセージはありません</p>
                    @endforelse
                </div>
                @if (count($directMessageRooms) !== 0)
                    <a class="primary-btn" href="{{ route('front.direct-messages.index') }}">すべてのメッセージを見る</a>
                @endif
            </div>
        </section>

    @if ($params['type'] === 'buyer')
        <!-- 利用サービス -->
            <section class="my-service-list">
                <div class="container">
                    <h3>利用したサービス</h3>
                    <div class="my-services">
                        @forelse(auth()->user()->currentBuyTransactions as $buyTransaction)
                            <div class="my-service">
                                <div class="left-img">
                                    <img src="{{ $buyTransaction->service->eye_catch_image_path }}" alt="サービス画像">
                                </div>
                                <div class="middle-txt">
                                    <div class="category">
                                        <p>{{ $buyTransaction->service->category->name }}</p>
                                    </div>
                                    <div class="txt">
                                        <a href="{{ route('front.services.show', ['service' => $buyTransaction->service]) }}">
                                            {{ $buyTransaction->service->title }}
                                        </a>
                                    </div>
                                    <div class="price">
                                        <p>お布施　<span>¥{{ number_format($buyTransaction->service->price) }}</span></p>
                                    </div>
                                </div>
                                <div class="controls">
                                    <a class="message-show-btn"
                                       href="{{ route('front.transactions.messages.show', ['transaction' => $buyTransaction]) }}">
                                        取引メッセージへ
                                    </a>
                                </div>
                                <div class="right-status {{ $buyTransaction->status == 0 ? 'public' : '' }}">
                                    <p>{{ $buyTransaction->status_text }}</p>
                                </div>
                            </div>
                        @empty
                            <p>まだ利用したサービスはありません</p>
                        @endforelse
                    </div>
                    @if (count(auth()->user()->currentBuyTransactions) !== 0)
                        <a class="primary-btn" href="{{ route('front.mypage.buys.index') }}">すべて見る</a>
                    @endif
                </div>
            </section>
    @else
        <!-- 提供サービス -->
            <section class="my-service-list">
                <div class="container">
                    <h3>提供サービス</h3>
                    <div class="my-services">
                        @forelse($services as $service)
                            <a href="{{ route('front.services.show', ['service' => $service]) }}">
                                <div class="my-service">
                                    <div class="left-img">
                                        <img src="{{ $service->eye_catch_image_path }}" alt="サービス画像">
                                    </div>
                                    <div class="middle-txt">
                                        <div class="category">
                                            <p>{{ $service->category->name }}</p>
                                        </div>
                                        <div class="txt">
                                            {{ $service->title }}
                                        </div>
                                        <div class="price">
                                            <p>お布施　<span>¥{{ number_format($service->price) }}</span></p>
                                        </div>
                                    </div>
                                    <div class="right-status {{ $service->is_public ? 'public' : '' }}">
                                        <p>{{ $service->is_public_text }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p>まだ提供しているサービスはありません</p>
                        @endforelse
                    </div>
                    <div class="other-page-btn">
                        <a class="primary-btn" href="{{ route('front.mypage.services.index') }}">提供サービス管理へ</a>
                        <a class="primary-btn white" href="{{ route('front.mypage.services.create') }}">新しくサービスを提供する</a>
                    </div>
                </div>
            </section>

            <!-- 利用されたサービス -->
            <section class="my-service-list">
                <div class="container">
                    <h3>利用されたサービス</h3>
                    <div class="my-services">
                        @forelse(auth()->user()->currentSaleTransactions as $saleTransaction)
                            <div class="my-service">
                                <div class="left-img">
                                    <img src="{{ $saleTransaction->service->eye_catch_image_path }}" alt="サービス画像">
                                </div>
                                <div class="middle-txt">
                                    <div class="category">
                                        <p>{{ $saleTransaction->service->category->name }}</p>
                                    </div>
                                    <div class="txt">
                                        <a href="{{ route('front.services.show', ['service' => $saleTransaction->service]) }}">
                                            {{ $saleTransaction->service->title }}
                                        </a>
                                    </div>
                                    <div class="price">
                                        <p>お布施　<span>¥{{ number_format($saleTransaction->service->price) }}</span></p>
                                    </div>
                                </div>
                                <div class="controls">
                                    <a class="message-show-btn" href="{{ route('front.transactions.messages.show', ['transaction' => $saleTransaction]) }}">
                                        取引メッセージへ
                                    </a>
                                </div>
                                <div class="right-status {{ $saleTransaction->status == 0 ? 'public' : '' }}">
                                    <p>{{ $saleTransaction->status_text }}</p>
                                </div>
                            </div>
                        @empty
                            <p>まだ利用されたサービスはありません</p>
                        @endforelse
                    </div>
                        @if (count(auth()->user()->currentSaleTransactions) !== 0)
                        <div class="other-page-btn">
                            <a class="primary-btn" href="{{ route('front.mypage.sales.index') }}">すべて見る</a>
                            <a class="primary-btn white" href="{{ route('front.mypage.sales.request') }}">売上申請画面へ</a>
                        </div>
                    @endif
                </div>
            </section>
        @endif
    </div>
@endsection
