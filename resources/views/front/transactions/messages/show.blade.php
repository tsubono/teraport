@extends('front.layouts.app')

@section('title', '取引メッセージ詳細 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="deal-message">
            <div class="container">
                <h3>
                    <a href="{{ route('front.services.show', ['service' => $transaction->service]) }}" target="_blank">{{ $transaction->sale->title }}</a>
                    の取引メッセージ
                </h3>

                <div class="message-wrap">
                    @if ($transaction->status == 1)
                        <a href="{{ route('front.transactions.review', ['transaction' => $transaction]) }}">
                            評価を登録する
                        </a>
                    @endif
                    <div class="status-label {{ $transaction->status == 1 ? 'complete' : '' }}">
                        @if ($transaction->status == 1)
                            <span>解決済み</span>
                        @else
                            <span>相談中</span>
                        @endif
                    </div>

                    <div class="message-list">
                        <div class="request-for-purchase">
                            {!! nl2br(e($transaction->sale->request_for_purchase)) !!}
                        </div>
                        @foreach ($transaction->messages as $message)
                            <div class="message-item {{ $message->from_user_id === auth()->user()->id ? 'right' : 'left' }}">
                                @if ($message->from_user_id !== auth()->user()->id)
                                    <a href="{{ route('front.users.show', ['user' => $transaction->toUser]) }}" target="_blank">
                                        <img class="user-icon" src="{{ $transaction->toUser->display_icon_image_path }}" alt="アイコン" />
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
                        <form method="post" action="{{ route('front.transactions.messages.send', ['transaction' => $transaction]) }}" enctype="multipart/form-data" name="sendForm">
                            @csrf

                            <textarea name="content" rows="6" placeholder="メッセージを入力してください">{{ old('content') }}</textarea>

                            <div class="invalid-feedback" role="alert" id="error-text">
                                <strong></strong>
                            </div>

                            <div class="files">
                                <input type="file" name="files[]">
                                <input type="file" name="files[]">
                                <input type="file" name="files[]">
                            </div>

                            <div class="invalid-feedback" role="alert" id="error-file">
                                <strong></strong>
                            </div>

                            @if (auth()->user()->id === $transaction->service->user_id && $transaction->status != 1)
                                <div class="status-check">
                                    <label for="status-check">
                                        <input type="checkbox" name="status" value="1" id="status-check">解決済みにする
                                    </label>
                                </div>
                        @endif
                            <!-- TODO: リアルタイムバリデーション -->
                            <button type="button" class="send-btn">送信する</button>
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
            $('.send-btn').click (function() {
                if (!check()) {
                    return false;
                }
                document.sendForm.submit();
            });
        });

        /**
         * 入力値をチェックする
         * @returns {boolean}
         */
        function check()
        {
            let check = true;
            if ($('[name=content]').val() === '') {
                $('#error-text strong').text('本文を入力してください');
                check = false;
            }
            // TODO: 文字サイズチェック
            let textareValue = document.sendForm.content.value;
            let wordNumber = textareValue.length;
            if (wordNumber > 60000) {
                $('#error-text strong').text('60,000文字以内で入力してください');
                check = false;
            }

            // TODO: ファイルサイズチェック
            let totalSize = 0;
            $('input[type=file]').each(function(){
                if($(this).val()){
                    let file = $(this).prop('files')[0];
                    totalSize = totalSize + file.size;
                }
            });

            if(totalSize > 8000000){
                $('#error-file strong').text('一度にアップロードできる画像サイズの容量を超えました');
                $(this).val('');
                check = false;
            }

            return check;
        }
    </script>
@endsection
