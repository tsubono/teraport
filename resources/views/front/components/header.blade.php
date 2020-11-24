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
                        @if (auth()->user()->unreadNotifications->count() !== 0)
                            <span class="on-mark"></span>
                        @endif
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
                    <!-- お知らせ一覧 -->
                    @include('front.components.notifications')
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
                                        <div class="mypage-btn sp">
                                            <p><a href="{{ route('front.mypage.index') }}">マイページ</a></p>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <div class="logout-btn sp">
                                            <p><a onclick="document.logoutForm.submit();">ログアウト</a></p>
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

    <div class="header-info">
        てらぽーとに登録している寺院・僧侶はすべて、所轄庁で宗教法人として認可を受けた仏教寺院又は当該寺院に在籍する僧侶のみです。
    </div>

    @if (session('message'))
        <div class="flash-message">
            {{ session('message') }}
        </div>
    @endif
</header>
