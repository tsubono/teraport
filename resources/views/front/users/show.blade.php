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
                        <form method="post" action="{{ route('front.messages.create') }}">
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
                <h3>出品中のサービス</h3>
                <div class="my-services block">
                    @forelse($user->public_services as $service)
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
