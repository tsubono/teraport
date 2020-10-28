@extends('front.layouts.app')

@section('title', 'メッセージ詳細 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <!-- メッセージ詳細 -->
        <section class="deal-message">
            <div class="container">
                <h3>○○さんとのメッセージ</h3>
                <div class="message-wrap">
                    <div class="message-list">
                        <div class="message-item right">
                            <div class="content">
                                <div class="row">
                                    <div class="message-txt">
                                        こんにちは！こんにちは！こんにちは！こんにちは！こんにちは！ <br>
                                        こんにちは！こんにちは！こんにちは！こんにちは！こんにちは！
                                    </div>
                                </div>
                                <div class="send-at">2020年10月15日 12:00</div>
                                <div class="is-read">既読</div>
                            </div>
                        </div>

                        <div class="message-item left">
                            <a href="{{ route('front.users.show', ['user' => 1]) }}" target="_blank">
                                <img class="user-icon" src="{{ asset('img/default-icon.png') }}" alt="アイコン" />
                            </a>
                            <div class="content">
                                <div class="row">
                                    <div class="message-txt">
                                        こんにちは！こんにちは！こんにちは！こんにちは！こんにちは！ <br>
                                        こんにちは！こんにちは！こんにちは！こんにちは！こんにちは！
                                    </div>
                                </div>
                                <div class="send-at">
                                    2020年10月15日 12:00
                                </div>
                            </div>
                        </div>

                        <div class="message-item left">
                            <a href="{{ route('front.users.show', ['user' => 1]) }}" target="_blank">
                                <img class="user-icon" src="{{ asset('img/default-icon.png') }}" alt="アイコン" />
                            </a>
                            <div class="content">
                                <div class="row">
                                    <div class="message-txt">
                                        こんにちは！こんにちは！こんにちは！こんにちは！こんにちは！ <br>
                                        こんにちは！こんにちは！こんにちは！こんにちは！こんにちは！
                                    </div>
                                </div>
                                <div class="send-at">
                                    2020年10月15日 12:00
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="message-form">
                        <form method="post" action="{{ route('front.messages.send', ['message' => 1]) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="message_id" value="1">

                            <textarea name="content" rows="6" placeholder="メッセージを入力してください">{{ old('content') }}</textarea>

                            @error('content')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <div class="files">
                                <input type="file" name="file_1">
                                <input type="file" name="file_2">
                                <input type="file" name="file_3">
                            </div>

                            <button type="submit" class="send-btn" >送信する</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
      </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('[name=content]').keyup (function() {
                if ($(this).val() !== '') {
                    $('.send-btn').prop('disabled', false);
                } else {
                    $('.send-btn').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
