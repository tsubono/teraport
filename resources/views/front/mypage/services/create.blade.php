@extends('front.layouts.app')

@section('title', 'サービス登録 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="user-profile-edit">
            <div class="container">
                <h2>サービス登録</h2>

                <div class="form-content service-form">
                    <form action="{{ route('front.mypage.services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('front.mypage.services._form-items')

                        <label class="term-check">
                            <input type="checkbox" class="require-check">注意事項を確認しました
                        </label>

                        <div class="form-footer">
                            <button type="submit" class="submit-btn" disabled>
                                登録する
                            </button>
                            <div class="default-btn return-btn">
                                <a href="{{ route('front.mypage.services.index') }}">一覧に戻る</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
