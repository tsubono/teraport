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

</body>
<!-- /body -->
</html>
