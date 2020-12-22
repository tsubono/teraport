@extends('front.layouts.app')

@section('title', '500 エラー | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
      <div class="container">
        <div class="error-txt">
          <h2>サーバーエラーが発生しました。</h2>
          <p>サーバーの問題でお探しのページを表示できません。<br>
              再度時間をおいてアクセスしてください。</p>
        </div>
      </div>
    </div>
@endsection
