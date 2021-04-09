<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K8VJF62');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="お寺・お坊さんのオンラインサービス窓口。リモートに特化したお坊さんを探そう。葬儀、法事、水子供養、人生相談、講師、セミナー、御朱印、お守り、お墓相談、文化・教育・スポーツ指導など、オンライン対応のお寺・お坊さんが見つかるマッチングサイト。">
    <!-- font-family -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;400&display=swap" rel="stylesheet">
    <!-- アイコンリンク -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="{{ mix('css/reset.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ mix('css/common.css') }}" type="text/css">
    <link rel="icon" href="{{ secure_asset('img/favicon.ico') }}">

    @yield('style')
</head>
