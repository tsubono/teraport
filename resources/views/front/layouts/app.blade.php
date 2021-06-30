<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- head -->
@include('front.components.head')
<!-- /head -->

<!-- body -->
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K8VJF62"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- header -->
@include('front.components.header')
<!-- /header -->

@if (request()->is('/'))
    <section class="top-catch"></section>
@endif

<main id="app">
<!-- content -->
@yield('content')
<!-- /content -->
</main>

@yield('bottom-content')

<!-- javascript -->
@include('front.components.js')
<!-- /javascript -->

<!-- footer -->
@include('front.components.footer')
<!-- /footer -->

<!-- Yahoo! JAPANユニバーサルタグ -->
<script type="text/javascript">
  (function () {
    var tagjs = document.createElement("script");
    var s = document.getElementsByTagName("script")[0];
    tagjs.async = true;
    tagjs.src = "//s.yjtag.jp/tag.js#site=YJ5kNuE";
    s.parentNode.insertBefore(tagjs, s);
  }());
</script>
<noscript>
    <iframe src="//b.yjtag.jp/iframe?c=YJ5kNuE" width="1" height="1" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
</noscript>
<!-- /Yahoo! JAPANユニバーサルタグ -->
</body>
<!-- /body -->
</html>
