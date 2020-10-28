@extends('front.layouts.app')

@section('title', 'サービス一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="my-service-list">
            <div class="container">
                <h2>出品サービス一覧</h2>
                <div class="register-btn">
                    <button onclick="location.href='{{ route('front.mypage.services.create') }}'">新規追加</button>
                </div>
                <div class="my-services block">
                    @forelse($services as $service)
                        <div class="my-service">
                            <div class="img">
                                <img class="service-image" src="{{ $service->eye_catch_image_path }}" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <div class="category">
                                    <p>{{ $service->category->name }}</p>
                                </div>
                                <div class="txt">
                                    {!! nl2br(e($service->content)) !!}
                                </div>
                                <div class="price">
                                    <p><span>¥{{ number_format($service->price) }}</span></p>
                                </div>
                                <div class="public-status">
                                    <span class="{{ $service->is_public ? 'public' : '' }}">
                                        {{ $service->is_public_text }}
                                    </span>
                                </div>
                            </div>
                            <div class="controls">
                                <button class="edit-btn" onclick="location.href='{{ route('front.mypage.services.edit', ['service' => $service]) }}'">
                                    編集
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="margin-auto">まだ登録されていません</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
