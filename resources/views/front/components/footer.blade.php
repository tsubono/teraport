<footer>
    <div class="container">
        <div class="top">
            <div class="left-title">
                <p>サービスを探す</p>
            </div>
            <div class="right-btn">
                <div class="register-btn">
                    <p><a href="{{ route('register') }}">新規登録</a></p>
                </div>
                <div class="login-btn">
                    <p><a href="{{ route('login') }}">ログイン</a></p>
                </div>
            </div>
        </div>
        <div class="bottom-nav-bar">
            <nav>
                <ul>
                    @foreach ($categories as $category)
                        <li><a href="{{ route('front.services.index') }}?c={{ $category->id }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="copy-right">
            <p><small>© 2020 てらぽーと</small></p>
        </div>
    </div>
</footer>
