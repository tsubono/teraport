@extends('front.layouts.app')

@section('title', 'サービス編集 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="user-profile-edit">
            <div class="container">
                <h2>サービス編集</h2>

                <div class="form-content service-form">
                    <form action="{{ route('front.mypage.services.update', ['service' => 1]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('front.mypage.services._form-items')

                        <div class="form-footer">
                            <button type="submit" class="submit-btn">
                                更新する
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
