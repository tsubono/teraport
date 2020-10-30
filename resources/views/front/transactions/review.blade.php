@extends('front.layouts.app')

@section('title', '評価登録 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">

@endsection

@section('content')
    <div class="page-content">
        <section class="review-section">
            <div class="container">
                <h3>評価登録</h3>

                <form action="{{ route('front.transactions.review.store', ['transaction'=> $transaction]) }}" method="post">
                    @csrf

                    <button type="submit" class="submit-btn">登録する</button>
                </form>
            </div>
        </section>
      </div>
@endsection
