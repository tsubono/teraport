@extends('front.layouts.app')

@section('title', '利用したサービス | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="my-service-list">
            <div class="container">
                <h2>利用したサービス (取引一覧)</h2>
                <div class="my-services">
                    @forelse($transactions as $transaction)
                        <div class="my-service">
                            <div class="left-img">
                                <img src="{{ $transaction->service->eye_catch_image_path }}" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>{{ $transaction->service->category->name }}</p>
                                </div>
                                <div class="txt">
                                    <a href="{{ route('front.services.show', ['service' => $transaction->service]) }}">
                                        {{ $transaction->service->title }}
                                    </a>
                                </div>
                                <div class="price">
                                    <p>お布施　<span>¥{{ number_format($transaction->service->price) }}</span></p>
                                </div>
                            </div>
                            <div class="controls">
                                <a class="message-show-btn" href="{{ route('front.transactions.messages.show', ['transaction' => $transaction]) }}">
                                    取引メッセージへ
                                </a>
                            </div>
                            <div class="right-status {{ $transaction->status == 0 ? 'public' : '' }}">
                                <p>{{ $transaction->status_text }}</p>
                            </div>
                        </div>
                    @empty
                        <p>まだ利用したサービスはありません</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
