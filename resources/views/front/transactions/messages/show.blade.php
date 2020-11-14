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

                @if ($transaction->status == 1 && empty($transaction->myReview))
                    <a class="primary-btn" href="{{ route('front.transactions.review', ['transaction' => $transaction]) }}">
                        評価を登録する
                    </a>
                @endif

                @if (!empty($transaction->receiveReview))
                    <div class="reviews">
                        <div class="review">
                            <div class="face-img">
                                <img class="user-image" src="{{ $transaction->receiveReview->fromUser->display_icon_image_path }}" alt="アイコン">
                            </div>
                            <div class="middle-txt">
                                <div class="user-name">
                                    {{ $transaction->receiveReview->fromUser->name }}
                                </div>
                                <div class="rate">
                                    <label class="{{ 1 <= $transaction->receiveReview->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 2 <= $transaction->receiveReview->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 3 <= $transaction->receiveReview->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 4 <= $transaction->receiveReview->rate ? 'active' : '' }}">★</label>
                                    <label class="{{ 5 <= $transaction->receiveReview->rate ? 'active' : '' }}">★</label>
                                </div>
                                <div class="content">
                                    {!! nl2br(e($transaction->receiveReview->content)) !!}
                                </div>
                                <div class="review-at">
                                    {{ $transaction->receiveReview->created_at->format('Y-m-d') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="message-wrap">
                    @if ($transaction->status == \App\Models\Transaction::STATUS_COMPLETE)
                        <div class="status-label complete">
                            <span>相談中</span>
                        </div>
                    @elseif ($transaction->status == \App\Models\Transaction::STATUS_CANCEL_REQUEST)
                        <div class="status-label cancel-request">
                            <span>キャンセルリクエスト承認待ち</span>
                        </div>
                        @if ($transaction->cancel_by_user_id !== auth()->user()->id)
                            <div class="cancel-confirm-area">
                                <p class="text-danger">キャンセルリクエストが届いています。下記から操作を行ってください。</p>
                                <form action="{{ route('front.transactions.cancel.approval', ['transaction' => $transaction]) }}" method="post">
                                    @csrf
                                    <button type="button" class="cancel-approval-btn">承認する</button>
                                </form>
                                <form action="{{ route('front.transactions.cancel.disapproval', ['transaction' => $transaction]) }}" method="post">
                                    @csrf
                                    <button type="button" class="cancel-disapproval-btn">否認する</button>
                                </form>
                            </div>
                        @endif
                    @elseif ($transaction->status == \App\Models\Transaction::STATUS_CANCEL)
                        <div class="status-label cancel">
                            <span>キャンセル</span>
                        </div>
                    @else
                        <div class="status-label">
                            <span>相談中</span>
                        </div>
                   @endif

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

                                <div class="invalid-feedback" role="alert" id="error-file">
                                    <strong></strong>
                                </div>
                            </div>

                            @if (auth()->user()->id === $transaction->service->user_id && $transaction->status != 1)
                                <div class="status-check">
                                    <label for="status-check">
                                        <input type="checkbox" name="status" value="1" id="status-check">解決済みにする
                                    </label>
                                </div>
                            @endif
                            <button type="button" class="send-btn">送信する</button>
                        </form>

                        @if (empty($transaction->status))
                            <div class="cancel-area">
                                <form action="{{ route('front.transactions.cancel.request', ['transaction' => $transaction]) }}" method="post">
                                    @csrf
                                    <button type="button" class="cancel-request-btn">キャンセルリクエスト</button>
                                </form>
                            </div>
                       @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('.cancel-request-btn').click (function() {
                if (confirm('キャンセルリクエストを送信します。よろしいですか？')) {
                    $(this).parent('form').submit();
                }
            });
            $('.cancel-approval-btn').click (function() {
                if (confirm('キャンセルリクエストを承認します。よろしいですか？')) {
                    $(this).parent('form').submit();
                }
            });
            $('.cancel-disapproval-btn').click (function() {
                if (confirm('キャンセルリクエストを否認します。よろしいですか？')) {
                    $(this).parent('form').submit();
                }
            });
        });
    </script>
@endsection
