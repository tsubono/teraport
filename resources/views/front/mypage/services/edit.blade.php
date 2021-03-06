@extends('front.layouts.app')

@section('title', 'サービス編集 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="user-profile-edit">
            <div class="container">
                <h2>サービス編集</h2>

                <div class="form-content service-form">
                    <form action="{{ route('front.mypage.services.update', ['service' => $service]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('front.mypage.services._form-items')

                        <div class="form-footer">
                            <button type="submit" class="submit-btn">
                                更新する
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
