<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- head -->
@include('front.components.head')
<!-- /head -->

<!-- body -->
<body>
<!-- header -->
@include('front.components.header')
<!-- /header -->

<div class="header-info">
    てらぽーとに登録している寺院・僧侶はすべて、所轄庁で宗教法人として認可を受けた仏教寺院又は当該寺院に在籍する僧侶のみです。
</div>

<main id="app">
<!-- content -->
@yield('content')
<!-- /content -->
</main>

<!-- javascript -->
@include('front.components.js')
<!-- /javascript -->

<!-- footer -->
@include('front.components.footer')
<!-- /footer -->

</body>
<!-- /body -->
</html>
