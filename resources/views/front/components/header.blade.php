<header>
    <div class="container">
        <div class="page-top">
            <a class="left" href="{{ url('/') }}">
                <h1>てらぽーと</h1>
                <div class="icon">
                    <img src="{{ secure_asset('img/logo.svg') }}" alt="ロゴ">
                </div>
            </a>
            <div class="right-items">
                <!-- 未ログインの場合 -->
                @if (!auth()->check())
                    <div class="login-btn">
                        <p><a href="{{ route('login') }}">ログイン</a></p>
                    </div>
                <!-- ログイン済みの場合 -->
                @else
                    <div class="bell-icon notification-popup">
                        <span class="material-icons">notifications_none</span>
                        @if (auth()->user()->unreadNotifications->count() !== 0)
                            <span class="on-mark"></span>
                        @endif
                    </div>
                    <div class="mypage-btn">
                        <p><a href="{{ route('front.mypage.index') }}">マイページ</a></p>
                    </div>
                    <!-- お知らせ一覧 -->
                    @include('front.components.notifications')
                @endif

                <!-- ハンバーガーメニュー -->
                <div id="nav-drawer">
                    <input type="checkbox" id="nav-input" class="nav-unshown">
                    <label for="nav-input" id="nav-open">
                        <span class="material-icons">menu</span>
                        <p class="nav-text">メニュー</p>
                    </label>
                    <label for="nav-input" class="nav-unshown" id="nav-close"></label>
                    <div class="nav-content">
                        <label for="nav-input">
                            <span class="material-icons" id="close">close</span>
                        </label>
                        <div>
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
                                </div>
                                <div class="user-account">
                                    <div class="buttons">
                                        <div class="mypage-btn">
                                            <p><a href="{{ route('front.mypage.index') }}">マイページ</a></p>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <div class="logout-btn">
                                            <p><a onclick="document.getElementById('logoutForm').submit();">ログアウト</a></p>
                                            <form action="{{ route('logout') }}" method="post" id="logoutForm">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="nav">
                                <nav>
                                    <ul>
                                        <li class="nav-menu">サービスを探す</li>
                                        @foreach ($categories as $category)
                                            <li><a href="{{ route('front.services.index') }}?c={{ $category->id }}">{!! $category->name !!}</a></li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                            <a class="contact-button" href="{{ route('front.contact.index') }}">
                                お問い合わせ
                            </a>
                            @include('front.components.sns-list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="description-text">お寺のオンラインサービス窓口</div>
    </div>

    @if (session('message'))
        <div class="flash-message">
            {{ session('message') }}
        </div>
    @endif
</header>
