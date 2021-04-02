@extends('front.layouts.app')

@section('title', 'メッセージ詳細 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/message.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="deal-message">
            <div class="container">
                <h3>
                    <a href="{{ route('front.users.show', ['user' => $room->toUser]) }}" target="_blank">
                        {{ $room->toUser->name }}
                    </a>さんとのメッセージ
                </h3>
                <div class="message-wrap">
                    <div class="message-list">
                        @foreach ($room->messages as $message)
                            <div class="message-item {{ $message->from_user_id === auth()->user()->id ? 'right' : 'left' }}">
                                @if ($message->from_user_id !== auth()->user()->id)
                                    <a href="{{ route('front.users.show', ['user' => $room->toUser]) }}" target="_blank">
                                        <img class="user-icon" src="{{ $room->toUser->display_icon_image_path }}" alt="アイコン" />
                                    </a>
                                @endif
                                <div class="content">
                                    <div class="row">
                                        <div class="message-txt">
                                            {!! nl2br(e($message->content)) !!}

                                            @if (count($message->files) !== 0)
                                                <div class="file-content">
                                                    @foreach ($message->files as $file)
                                                        <a href="{{ route('front.direct-messages.download', ['file' => $file]) }}">{{ $file->file_name }}</a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="send-at">{{ $message->created_at->format('Y年m月d日 H:i') }}</div>
                                    @if ($message->is_read && $message->from_user_id === auth()->user()->id)
                                        <div class="is-read">既読</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="message-form">
                        <form method="post" action="{{ route('front.direct-messages.send', ['room' => $room]) }}" enctype="multipart/form-data" name="sendForm">
                            @csrf

                            <textarea name="content" rows="6" placeholder="メッセージを入力してください">{{ old('content') }}</textarea>

                            <div class="invalid-feedback" role="alert" id="error-text">
                                <strong></strong>
                            </div>

                            <div class="files">
                                <input type="file" name="files[]">
                                <input type="file" name="files[]">
                                <input type="file" name="files[]">

                                <div class="invalid-feedback" role="alert" id="error-file">
                                    <strong></strong>
                                </div>
                            </div>
                            <button type="button" class="send-btn">送信する</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
      </div>
@endsection

