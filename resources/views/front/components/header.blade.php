<header>
    <div class="container">
        <div class="page-top">
            <a class="left" href="{{ url('/') }}">
                <h1>てらぽーと</h1>
                <div class="icon">
                    <img src="{{ asset('img/logo.png') }}" alt="ロゴ">
                </div>
            </a>
            <div class="right-items">
                <!-- 未ログインの場合 -->
                @if (!auth()->check())
                    <div class="register-btn">
                        <p><a href="{{ route('register') }}">新規登録</a></p>
                    </div>
                    <div class="login-btn">
                        <p><a href="{{ route('login') }}">ログイン</a></p>
                    </div>
                <!-- ログイン済みの場合 -->
                @else
                    <div class="face-img">
                        <img class="user-image" src="{{ auth()->user()->display_icon_image_path }}" alt="アイコン">
                    </div>
                    <div class="fullname">
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="bell-icon notification-popup">
                        <span class="material-icons">notifications_none</span>
                        <span class="on-mark"></span>
                    </div>
                    <div class="mypage-btn">
                        <p><a href="{{ route('front.mypage.index') }}">マイページ</a></p>
                    </div>
                    <div class="logout-btn">
                        <p><a onclick="document.logoutForm.submit();">ログアウト</a></p>
                    </div>
                    <form action="{{ route('logout') }}" method="post" name="logoutForm">
                        @csrf
                    </form>
                    <div class="notification-messages" style="display: none">
                        <div class="message">
                            <div class="title">
                                <p>○○さんからメッセージが届いています。</p>
                            </div>
                            <div class="txt">
                                <p>メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッ …</p>
                            </div>
                            <a class="check-message">
                                <p>メッセージを確認する</p>
                            </a>
                        </div>

                        <div class="message">
                            <div class="title">
                                <p>○○さんからメッセージが届いています。</p>
                            </div>
                            <div class="txt">
                                <p>メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッ …</p>
                            </div>
                            <a class="check-message">
                                <p>メッセージを確認する</p>
                            </a>
                        </div>
                        <div class="message">
                            <div class="title">
                                <p>○○さんからメッセージが届いています。</p>
                            </div>
                            <div class="txt">
                                <p>メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッ …</p>
                            </div>
                            <a class="check-message">
                                <p>メッセージを確認する</p>
                            </a>
                        </div>
                        <div class="message">
                            <div class="title">
                                <p>○○さんからメッセージが届いています。</p>
                            </div>
                            <div class="txt">
                                <p>メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッセージ内容。メッ …</p>
                            </div>
                            <a class="check-message">
                                <p>メッセージを確認する</p>
                            </a>
                        </div>
                        <a class="check-all-messages">
                            <p>全てのお知らせを見る</p>
                        </a>
                    </div>
                @endif

                <!-- スマホ用メニュー -->
                <div id="nav-drawer">
                    <input type="checkbox" id="nav-input" class="nav-unshown">
                    <label for="nav-input" id="nav-open">
                        <span class="material-icons">menu</span>
                    </label>
                    <label for="nav-input" class="nav-unshown" id="nav-close"></label>
                    <div class="nav-content">
                        <label for="nav-input">
                            <span class="material-icons" id="close">close</span>
                        </label>
                        <!-- 未ログインの場合 -->
                        @if (!auth()->check())
                            <div class="buttons">
                                <div class="register-btn">
                                    <p><a href="{{ route('register') }}">新規登録</a></p>
                                </div>
                                <div class="login-btn">
                                    <p><a href="{{ route('login') }}">ログイン</a></p>
                                </div>
                            </div>
                        <!-- ログイン済みの場合 -->
                        @else
                            <div class="user-info">
                                <div class="face-img">
                                    <img class="user-image" src="{{ auth()->user()->display_icon_image_path }}"
                                         alt="アイコン">
                                </div>
                                <div class="fullname">
                                    <p>{{ auth()->user()->name }}</p>
                                </div>
                                <div class="buttons">
                                    <div class="mypage-btn">
                                        <p><a href="{{ route('front.mypage.index') }}">マイページ</a></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="nav">
                            <nav>
                                <ul>
                                    <li class="nav-menu">サービスを探す</li>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('front.services.index') }}?c={{ $category->id }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-bar">
        <nav>
            <ul>
                <li class="nav-menu">サービスを探す</li>
                @foreach ($categories as $category)
                    <li><a href="{{ route('front.services.index') }}?c={{ $category->id }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
    @if (session('message'))
        <div class="flash-message">
            {{ session('message') }}
        </div>
    @endif
</header>
