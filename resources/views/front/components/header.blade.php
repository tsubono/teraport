<header>
    <div class="container">
        <div class="page-top">
            <div class="left" onclick="location.href='/'">
                <h1>てらぽーと</h1>
                <div class="icon">
                    <img src="{{ asset('img/logo.png') }}" alt="ロゴ">
                </div>
            </div>
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
                        <img src="{{ auth()->user()->icon_image_path ?? asset('img/default-icon.png') }}" alt="アイコン">
                    </div>
                    <div class="fullname">
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="bell-icon">
                        <img src="{{ asset('img/bell.png') }}" alt="ベル">
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
                @endif

                <!-- スマホ用メニュー -->
                <div id="nav-drawer">
                    <input type="checkbox" id="nav-input" class="nav-unshown">
                    <label for="nav-input" id="nav-open">
                        <span class="material-icons">menu</span>
                    </label>
                    <label for="nav-input" class="nav-unshown" id="nav-close"></label>
                    <div class="nav-content">
                        <span class="material-icons" id="close">close</span>
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
                                    <img src="{{ auth()->user()->icon_image_path ?? asset('img/default-icon.png') }}"
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
