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

                        <div class="form-footer">
                            <button type="submit" class="submit-btn">
                                登録する
                            </button>
                            <button type="button" class="default-btn return-btn" onclick="location.href='{{ route('front.mypage.services.index') }}'">
                                一覧に戻る
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
