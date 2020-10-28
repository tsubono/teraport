@extends('front.layouts.app')

@section('title', 'プロフィール | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="user-profile">
            <div class="container">
                <h3>プロフィール</h3>
                <div class="my-profile">
                    <div class="my-img">
                        <img src="{{ $user->icon_image_path ?? asset('img/default-icon.png') }}" alt="アイコン">
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
            </div>
        </section>
      </div>
@endsection
