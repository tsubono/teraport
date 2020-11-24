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
