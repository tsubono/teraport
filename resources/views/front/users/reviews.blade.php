@extends('front.layouts.app')

@section('title', '評価一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="review-section">
            <div class="container">
                <h2>評価一覧</h2>
                <div class="reviews">
                    @forelse($reviews as $review)
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
                                <div class="review-at">
                                    {{ $review->created_at->format('Y-m-d') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="margin-auto">まだ登録されていません</div>
                    @endforelse
                </div>

                {{ $reviews->links('pagination::default') }}
            </div>
        </section>
    </div>
@endsection
