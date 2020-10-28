@extends('front.layouts.app')

@section('title', 'サービス詳細 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            <h2>{{ $service->title }}</h2>

            <div class="service-show">
                <div class="main-content">
                    <div class="flex-area">
                        <div class="service-images">
                            <div class="main-image">
                                <img src="{{ $service->eye_catch_image_path }}" alt="サービス画像" />
                            </div>
                            <div class="sub-images">
                                <img src="{{ $service->sub_image_path1 }}" alt="サービス画像" />
                                <img src="{{ $service->sub_image_path2 }}" alt="サービス画像" />
                            </div>
                        </div>
                        <div class="service-content">
                            <h3>内容</h3>
                            <div>
                                {!! nl2br(e($service->content)) !!}
                            </div>
                        </div>
                    </div>
                    @if (!empty($service->request_for_purchase))
                        <h3>購入にあたってのお願い</h3>
                        <div>
                            {!! nl2br(e($service->request_for_purchase)) !!}
                        </div>
                    @endif
                </div>
                <div class="side-content">
                    <div class="seller-info">
                        <img src="{{ $service->user->icon_image_path }}" alt="アイコン">
                        <a href="{{ route('front.users.show', ['user' => 1]) }}">{{ $service->user->name }}</a>
                        <div class="valuation">
                            <span class="star"></span> 5.0
                        </div>
                    </div>
                    <div class="buy-area">
                        <div class="price">¥{{ number_format($service->price) }}</div>
                        <button class="submit-btn">購入する</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('.service-images .sub-images img').click (function() {
                const src = $(this).attr('src');
                const base_src = $('.main-image img').attr('src');
                $('.main-image img').attr('src', src);
                $(this).attr('src', base_src)
            });
        });
    </script>
@endsection
