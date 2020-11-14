@extends('front.layouts.app')

@section('title', 'プロフィール | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="user-profile">
            <div class="container">
                <h3>プロフィール</h3>
                <div class="my-profile">
                    <div class="my-img">
                        <img class="user-image" src="{{ $user->display_icon_image_path }}" alt="アイコン">
                    </div>
                    <div class="my-info">
                        <div class="my-name">
                            <p>{{ $user->name }}</p>
                        </div>
                        @if (!empty($user->real_name))
                            <p class="real-name">実名: {{ $user->real_name }}</p>
                        @endif
                        <div class="rate">
                            <label class="active">★</label>
                            &nbsp;{{ $user->ratePoint }}
                        </div>
                        <div class="txt">
                            {!! nl2br(e($user->introduction)) !!}
                        </div>
                        <div class="my-status">
                            <p>性別：{{ $user->gender }}</p>
                            <p>職業：{{ $user->job }}</p>
                            <p>活動エリア：{{ $user->area }}</p>
                        </div>
                    </div>
                </div>
                @if ($user->id !== auth()->user()->id)
                    <div class="message-btn-area">
                        <form method="post" action="{{ route('front.direct-messages.store') }}">
                            @csrf
                            <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                            <button type="submit" class="submit-btn sub">メッセージを送る</button>
                        </form>
                    </div>
                @endif
            </div>
        </section>

        <section class="my-service-list">
            <div class="container">
                <h3>提供中のサービス</h3>
                <div class="my-services block">
                    @forelse($user->public_services as $service)
                        <a href="{{ route('front.services.show', ['service' => $service]) }}">
                            <div class="my-service">
                                <div class="img">
                                    <img class="service-image" src="{{ $service->eye_catch_image_path }}" alt="サービス画像">
                                </div>
                                <div class="middle-txt">
                                    <div class="category">
                                        <p>{{ $service->category->name }}</p>
                                    </div>
                                    <div class="txt">
                                        {{ $service->title }}
                                    </div>
                                    <div class="price">
                                        <p><span>¥{{ number_format($service->price) }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="margin-auto">まだ登録されていません</div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="review-section">
            <div class="container">
                <h3>評価</h3>
                <div class="reviews">
                    @forelse($user->current_reviews as $review)
                        <div class="review">
                            <div class="face-img">
                                <img class="user-image" src="{{ $review->fromUser->display_icon_image_path }}" alt="アイコン">
                            </div>
                            <div class="middle-txt">
                                <div class="user-name">
                                    {{ $review->fromUser->name }}
                                </div>
                                <div class="rate">
                                    <label class="{{ 1 <= $review->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 2 <= $review->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 3 <= $review->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 4 <= $review->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 5 <= $review->rate ? 'active' : '' }}">★</label>
                                </div>
                                <div class="content">
                                    {!! nl2br(e($review->content)) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="margin-auto">まだ登録されていません</div>
                    @endforelse
                </div>
                @if (count($user->current_reviews) !== 0)
                    <a class="primary-btn" href="{{ route('front.users.reviews', ['user' => $user]) }}">すべての評価を見る</a>
                @endif
            </div>
        </section>
      </div>
@endsection
