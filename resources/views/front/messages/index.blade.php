@extends('front.layouts.app')

@section('title', 'メッセージ一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <!-- メッセージ一覧 -->
        <section class="deal-message">
            <div class="container">
                <h3>メッセージ一覧</h3>
                <div class="deal-msgs">
                    <div class="deal-msg">
                        <div class="dealer-info">
                            <div class="face-img">
                                <img src="../img/face8.png" alt="顔写真">
                            </div>
                            <div class="name">
                                <p>寺院 次郎</p>
                            </div>
                        </div>
                        <div class="txt">
                            <p>メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセ…</p>
                        </div>
                        <div class="check-message">
                            <p><a href="{{ route('front.messages.show', ['message' => 1]) }}">メッセージを確認する</a></p>
                        </div>
                    </div>

                    <div class="deal-msg">
                        <div class="dealer-info">
                            <div class="face-img">
                                <img src="../img/face9.png" alt="顔写真">
                            </div>
                            <div class="name">
                                <p>寺院 次郎</p>
                            </div>
                        </div>
                        <div class="txt">
                            <p>メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセ…</p>
                        </div>
                        <div class="check-message">
                            <p><a href="{{ route('front.messages.show', ['message' => 1]) }}">メッセージを確認する</a></p>
                        </div>
                    </div>

                    <div class="deal-msg">
                        <div class="dealer-info">
                            <div class="face-img">
                                <img src="../img/face10.png" alt="顔写真">
                            </div>
                            <div class="name">
                                <p>寺院 次郎</p>
                            </div>
                        </div>
                        <div class="txt">
                            <p>メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセ…</p>
                        </div>
                        <div class="check-message">
                            <p><a href="{{ route('front.messages.show', ['message' => 1]) }}">メッセージを確認する</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
@endsection
