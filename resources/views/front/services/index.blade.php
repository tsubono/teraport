@extends('front.layouts.app')

@section('title', 'プロフィール | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="funeral-service">
            <div class="container">
                <h2>「{{ $categoryName }}」のサービス一覧</h2>

               @include('front.services._search-content')

                <div class="search-result">
                    <div class="result-top">
                        <div class="left">
                            <p><span>{{ $services->total() }}</span>件のサービスが見つかりました</p>
                        </div>
{{--                        <div class="right">--}}
{{--                            <div class="sort-select">--}}
{{--                                <select name="sort">--}}
{{--                                    <option>新着順</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <!-- サービス一覧 -->
                    <div class="service-list">
                        <div class="container">
                            <div class="service-items">
                                @forelse($services as $service)
                                    <div class="service-item" onclick="location.href='{{ route('front.services.show', ['service' => $service]) }}'">
                                        <div class="top-img">
                                            <img class="service-image" src="{{ $service->eye_catch_image_path }}" alt="サービス">
                                        </div>
                                        <div class="category-tag">
                                            <p>{{ $service->category->name }}</p>
                                        </div>
                                        <div class="main-txt">
                                            {!! nl2br(e($service->content)) !!}
                                        </div>
                                        <div class="price">
                                            <p><span>お布施</span>¥{{ number_format($service->price) }}</p>
                                        </div>
                                        <div class="person-info">
                                            <div class="left-img">
                                                <img class="user-image" src="{{ $service->user->display_icon_image_path }}" alt="アイコン">
                                            </div>
                                            <div class="fullname">
                                                <p>{{ $service->user->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="margin-auto">見つかりませんでした</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{ $services->appends(['c' => $params['c'] ?? '', 'keyword' => $params['keyword'] ?? ''])->links('pagination::default') }}
                </div>

                @include('front.services._search-content')

            </div>
        </section>
      </div>
@endsection
