@extends('front.layouts.app')

@section('title', 'サービス詳細 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            <h2>サービスタイトルサービスタイトルサービスタイトル</h2>

            <div class="service-show">
                <div class="main-content">
                    <img src="../img/service1.png" alt="サービス">
                    <h3>内容</h3>
                    <div>
                        サービス内容サービス内容サービス内容サービス内容サービス内容 <br>
                        サービス内容サービス内容サービス内容サービス内容サービス内容 <br>
                        サービス内容サービス内容サービス内容サービス内容サービス内容
                    </div>
                    <h3>購入にあたってのお願い</h3>
                    <div>
                        購入にあたってのお願い購入にあたってのお願い購入にあたってのお願い <br>
                        購入にあたってのお願い購入にあたってのお願い購入にあたってのお願い <br>
                        購入にあたってのお願い購入にあたってのお願い購入にあたってのお願い <br>
                        購入にあたってのお願い購入にあたってのお願い購入にあたってのお願い
                    </div>
                </div>
                <div class="side-content">
                    <div class="seller-info">
                        <img src="{{ asset('img/default-icon.png') }}" alt="アイコン" />
                        <a href="{{ route('front.users.show', ['user' => 1]) }}">ユーザー名</a>
                        <div class="valuation">
                            <span class="star"></span> 5.0
                        </div>
                    </div>
                    <div class="buy-area">
                        <div class="price">30,000円</div>
                        <button class="submit-btn">購入する</button>
                    </div>
                </div>
            </div>
        </div>
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
