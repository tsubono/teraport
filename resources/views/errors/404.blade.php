@extends('front.layouts.app')

@section('title', '404 エラー | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
@endsection

@section('content')
    <div class="page-content">
      <div class="container">
        <div class="error-txt">
          <h2>お探しのページは見つかりませんでした。</h2>
          <p>URLに誤りがあるか、移動もしくは削除された可能性があります。</p>
        </div>
      </div>
    </div>
@endsection
