@extends('front.layouts.app')

@section('title', '売上申請一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="admin-sale-request-section">
            <div class="container">
                <h2>売上申請一覧</h2>
            </div>
        </section>
    </div>
@endsection
