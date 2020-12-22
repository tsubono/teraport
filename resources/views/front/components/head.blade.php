<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="ニーズに合ったお寺・お坊さんが見つかるマッチングサイト。葬儀、法事、墓地、納骨、樹木葬、人生相談、体験修行、文化・芸術指導、施設貸出、寺院フリーマーケットなど、あなたが必要としているお寺・お坊さんがあなたを待ってます！">
    <!-- font-family -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;400&display=swap" rel="stylesheet">
    <!-- アイコンリンク -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="{{ secure_asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/common.css') }}">

    @yield('style')
</head>
