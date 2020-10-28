@extends('front.layouts.app')

@section('title', 'プロフィール | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="funeral-service">
            <div class="container">
                <h2>「葬儀・年回忌・供養」のサービス一覧</h2>

               @include('front.services._search-content')

                <div class="search-result">
                    <div class="result-top">
                        <div class="left">
                            <p><span>32</span>件のサービスが見つかりました</p>
                        </div>
                        <div class="right">
                            <div class="sort-select">
                                <select name="sort">
                                    <option>新着順</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- サービス一覧 -->
                    <div class="service-list">
                        <div class="container">
                            <div class="service-items">
                                <div class="service-item" onclick="location.href='{{ route('front.services.show', ['service' => 1]) }}'">
                                    <div class="top-img">
                                        <img src="../img/service1.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face1.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service2.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face2.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service3.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face3.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service4.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face5.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service5.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face6.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service6.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face1.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service1.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face1.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service2.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face2.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="top-img">
                                        <img src="../img/service3.png" alt="サービス">
                                    </div>
                                    <div class="category-tag">
                                        <p>人生・悩み・開運相談</p>
                                    </div>
                                    <div class="main-txt">
                                        <p>お悩み相談・人生相談、なんでも承ります！お悩み相談・人生相…</p>
                                    </div>
                                    <div class="price">
                                        <p><span>お布施目安</span>¥10,000 〜 ¥50,000</p>
                                    </div>
                                    <div class="person-info">
                                        <div class="left-img">
                                            <img src="../img/face3.png" alt="顔写真">
                                        </div>
                                        <div class="fullname">
                                            <p>山田 太郎</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="nav-links">
                        <a class="prev" href="https://">&lt;</a>
                        <a class="page-numbers current-page" href="https://">1</a>
                        <a class="page-numbers" href="https://">2</a>
                        <a class="page-numbers" href="https://">3</a>
                        <a class="page-numbers" href="https://">4</a>
                        <span class="dots">…</span>
                        <a class="page-numbers" href="https://">5</a>
                        <a class="next" href="https://">&gt;</a>
                    </div>
                </div>

                @include('front.services._search-content')

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
