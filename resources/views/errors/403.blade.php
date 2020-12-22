@extends('front.layouts.app')

@section('title', '403 エラー | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/error.css') }}">
@endsection

@section('content')
    <div class="page-content">
      <div class="container">
        <div class="error-txt">
          <h2>{{ $exception->getMessage() }}</h2>
        </div>
      </div>
    </div>
@endsection
