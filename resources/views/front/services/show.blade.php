@extends('front.layouts.app')

@section('title', 'サービス詳細 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            <h2>{{ $service->title }}</h2>

            <div class="service-show">
                <div class="main-content">
                    <div class="flex-area">
                        <div class="service-images">
                            <div class="main-image">
                                <img src="{{ $service->eye_catch_image_path }}" alt="サービス画像" />
                            </div>
                            <div class="sub-images">
                                <img src="{{ $service->sub_image_path1 }}" alt="サービス画像" />
                                <img src="{{ $service->sub_image_path2 }}" alt="サービス画像" />
                            </div>
                        </div>
                        <div class="service-content">
                            <h3>内容</h3>
                            <div>
                                {!! nl2br(e($service->content)) !!}
                            </div>
                        </div>
                    </div>
                    @if (!empty($service->request_for_purchase))
                        <div class="request-for-purchase">
                            <h3>利用にあたってのお願い</h3>
                            <div>
                                {!! nl2br(e($service->request_for_purchase)) !!}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="side-content {{ $service->user_id === auth()->user()->id ? 'own' : '' }}">
                    <div class="seller-info">
                        <img class="user-image" src="{{ $service->user->display_icon_image_path }}" alt="アイコン">
                        <a href="{{ route('front.users.show', ['user' => $service->user]) }}">{{ $service->user->name }}</a>
                        <p class="real-name">実名: {{ $service->user->real_name }}</p>
                        <div class="valuation">
                            <span class="star"></span> {{ $service->user->ratePoint }}
                        </div>
                    </div>
                    <div class="buy-area">
                        <div class="price">¥{{ number_format($service->price) }}</div>
                        @if ($service->user_id !== auth()->user()->id)
                            <button type="button" class="submit-btn confirm-button js-popup-open" data-id="confirm-modal">利用する</button>
                        @endif
                    </div>
                    <div class="message-btn-area">
                        <form method="post" action="{{ route('front.direct-messages.store') }}">
                            @csrf
                            <input type="hidden" name="to_user_id" value="{{ $service->user_id }}">
                            <button type="submit" class="submit-btn sub">メッセージを送る</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection

@section('bottom-content')
    <div class="popup js-popup" id="confirm-modal">
        <div class="popup-bg js-popup-close"></div>
        <div class="popup-content">
            <h3>サービスご利用確認</h3>
            <div class="terms-area mb-30">
                {!! nl2br(e("サービスの利用及び支払いに関する注意事項

1. 提供者からサービスの提供を利用する場合、当サイト所定のフォームより手続を行うものとします。
2. サービス提供契約は、利用者が前項１の手続を完了した時点を指し、提供者と当該利用者との間で成立します。
3. サービスの利用者は、メッセージ機能を使用して、サービスの詳細に関する質問や連絡をとることができます。また、利用者は提供者に対してサービス提供契約の履行を求めることができます。
4. 当サイトサービスにおけるお布施の支払方法はクレジットカードのみとします。クレジットカード使用の際、利用者は必ず本人名義のクレジットカードを使用して下さい。
5. サービスの利用者及び提供者はサービスの提供及び利用完了時に、お互いの対応について評価を付けますので、誠意のある対応を心掛けて下さい。
6. 提供者及び利用者との間でサービス提供契約が成立した後、止むを得ない理由で契約をキャンセルする場合は、必ずキャンセル手続（相手方への申請と承諾）をとり、トラブルの無いよう誠実な対応を心掛けて下さい。尚、キャンセル手続が成立した場合、提供者及び利用者双方とも評価は付けることができなくなります。　
7. サービスの提供契約成立後に、所定のキャンセル手続が行われた場合、当サイト運営者は利用者に対してお布施代金の返金手続きを行います。
8. 利用者が未成年の場合、当サイトサービスの利用につき、個別の取引にかかる申込を行う際は、必ず事前に親権者の同意等を得るものとします。
9. 当サイトを介して問い合わせ、申込み及びその他接触を持つに至った提供者との間で、又は当サイトにより知り得た提供者の個人情報を利用して、現に提供されている又は提供が可能なサービスについて当サイトサービスを介さずに直接取引をする行為及び直接取引を誘引又は誘引に応じる行為を固く禁じます。
10. 提供者によるサービスに以下の内容が含まれる場合、利用者は当サイト運営者に対して速やかに報告するものとします。当サイト運営者の判断により当該サービスの削除及び提供者資格を取り消すことができるものとします。
・法令又は公序良俗に反する内容を含む場合
・法令又は公序良俗に反する内容を含む場合
・特定の団体又は個人を非難又は誹謗中傷する内容を含む場合
・政治的思想を含む場合、特定宗教教団への強引な勧誘を含む場合
・利用者の目的と合致しない情報を提供する行為
・利用会員に対し誤解、不安、恐怖、損害等を与える恐れのある情報を含む場合

尚、当サイト運営者は、サービス提供契約の当事者となるものではなく、サービス提供契約につき、提供者又は利用者のいずれの立場に関する責任も負いませんのご注意下さい。

                ")) !!}
            </div>
            <label class="term-check">
                <input type="checkbox" class="require-check-stripe">注意事項を確認しました
            </label>
            <div class="buttons">
                <form action="{{ route('front.transactions.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ config('payment.stripe.public_key') }}"
                        data-amount="{{ $service->price }}"
                        data-name="サービス利用フォーム"
                        data-label="利用する"
                        data-description="Online course about integrating Stripe"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-currency="JPY"
                        disabled
                    >
                    </script>
                </form>
                <a class="js-popup-close default-btn">キャンセル</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('.service-images .sub-images img').click (function() {
                const src = $(this).attr('src');
                const base_src = $('.main-image img').attr('src');
                $('.main-image img').attr('src', src);
                $(this).attr('src', base_src)
            });
        });
    </script>
@endsection
