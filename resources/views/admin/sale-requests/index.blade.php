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

                <div class="sale-request-wrap">
                    <ul class="sale-request-list">
                        @forelse($saleRequests as $saleRequest)
                        <li class="sale-request-item">
                            <div class="left-item">
                                <div class="left-img">
                                    <img src="{{ $saleRequest->user->display_icon_image_path }}" alt="アイコン" class="user-image">
                                </div>
                                <div class="fullname">
                                    <p>{{ $saleRequest->user->name }}</p>
                                </div>
                                <div class="transfer-wrap">
                                    <div class="transfer-information">
                                        <p>
                                            振り込み金額: {{ number_format($saleRequest->price) }}円
                                        </p>
                                        <p>
                                            振り込み期限: {{ date('Y年m月d日',  strtotime($saleRequest->transfer_limit_date)) }}
                                        </p>
                                    </div>
                                    <p class="account">
                                        振り込み口座: {{ ($saleRequest->bank_name) }} {{ ($saleRequest->branch_name) }} {{ ($saleRequest->bank_number) }} {{ ($saleRequest->account_holder) }}
                                    </p>
                                </div>
                            </div>
                            <div class="right-item">
                                @if ($saleRequest->status === 1)
                                <p class="transfer-done">
                                    振り込み済み
                                </p>
                                @else
                                <form class="transfer-yet" action="{{ route('admin.sale-requests.update', ['saleRequest' => $saleRequest]) }}" method="POST">
                                    @csrf
                                    <button type="submit">振り込み済みにする</button>
                                </form>
                                @endif
                            </div>
                        </li>
                        @empty
                            <p>まだ振り込み申請はありません</p>
                        @endforelse
                    </ul>
                    {{ $saleRequests->links('pagination::default') }}
                </div>
            </div>

        </section>
    </div>
@endsection
