@extends('front.layouts.app')

@section('title', 'メッセージ一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="notification-section">
            <div class="container">
                <h2>通知一覧</h2>
                <div class="notifications">
                    @forelse($notifications as $index => $notification)
                        <div class="notification {{ is_null($notification->read_at) ? 'un-read' : '' }}">
                           <div>
                               <div class="title">
                                   <p>{{ $notification->data['title'] }}</p>
                               </div>
                               <div class="txt">
                                   {{ Str::limit($notification->data['body'], 120) }}
                               </div>
                           </div>
                            <a class="check-message" onclick="document.getElementById('notifyForm-{{ $index }}').submit()">
                                <p>確認する</p>
                            </a>
                            <form action="{{ route('front.notifications.read', ['notification' => $notification]) }}" method="post" id="notifyForm-{{ $index }}">
                                @csrf
                            </form>
                        </div>
                    @empty
                        <p>まだ通知はありません</p>
                    @endforelse
                </div>

                {{ $notifications->links('pagination::default') }}
            </div>
        </section>
      </div>
@endsection
