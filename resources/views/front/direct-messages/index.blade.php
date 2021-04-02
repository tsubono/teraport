@extends('front.layouts.app')

@section('title', 'メッセージ一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/message.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="deal-message">
            <div class="container">
                <h3>ダイレクトメッセージ一覧</h3>
                <div class="deal-msgs">
                    @forelse($directMessageRooms as $room)
                        <div class="deal-msg">
                            <div class="dealer-info">
                                <div class="face-img">
                                    <img src="{{ $room->toUser->display_icon_image_path }}" alt="アイコン">
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
            </div>
        </section>
      </div>
@endsection
