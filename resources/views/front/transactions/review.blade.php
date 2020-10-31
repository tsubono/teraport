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

                    <div class="form-group">
                        <label for="content">内容</label>
                        <textarea name="content" rows="10"></textarea>

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rate">評価</label>
                        <div class="rate-form">
                            <input id="star5" type="radio" name="rate" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rate" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rate" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rate" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rate" value="1">
                            <label for="star1">★</label>
                        </div>
                        @error('rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn register-btn">登録する</button>
                    </div>
                </form>
            </div>
        </section>
      </div>
@endsection
