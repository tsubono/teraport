@extends('front.layouts.app')

@section('title', '売上一覧 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ secure_asset('css/transaction.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="sale-request-section">
            <div class="container">
                <h2>売上申請</h2>
                <div class="head-link-btn">
                    <a class="primary-btn white" href="{{ route('front.mypage.sales.index') }}">利用されたサービス一覧へ</a>
                </div>
                <div class="sale-prices">
                    <div class="remain-total">
                        <div class="label">売上金残高</div>
                        <p class="price">¥{{ number_format($remainTotalPrice) }}</p>
                    </div>
                    <div class="total">
                        <div class="label">累計売上</div>
                        <p class="price">¥{{ number_format($totalPrice) }}</p>
                    </div>
                </div>
                <div class="request-form">
                    <form action="{{ route('front.mypage.sales.request.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="bank_name">銀行名</label>
                            <input id="bank_name" type="text" name="bank_name" value="{{ old('bank_name') }}">

                            @error('bank_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="branch_name">支店名</label>
                            <input id="branch_name" type="text" name="branch_name" value="{{ old('branch_name') }}">

                            @error('branch_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bank_number">口座番号</label>
                            <input id="bank_number" type="text" name="bank_number" value="{{ old('bank_number') }}">

                            @error('bank_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="account_holder">口座名義</label>
                            <input id="account_holder" type="text" name="account_holder" value="{{ old('account_holder') }}">

                            @error('account_holder')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="submit-btn register-btn">
                                振り込み申請する
                            </button>
                        </div>
                    </form>
                </div>
                <div class="scheduled-info">
                    <p class="scheduled-txt">次回振り込み予定: {{ $scheduledTransferDate }} ¥{{ number_format($scheduledTransferPrice) }}</p>
                </div>
            </div>
        </section>
    </div>
@endsection
