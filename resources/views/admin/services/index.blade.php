@extends('front.layouts.app')

@section('title', '出品サービス管理 | てらぽーと')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <section class="my-service-list">
            <div class="container">
                <div class="free-word-search">
                    <h3>検索</h3>
                    <form>
                        <input type="search" name="name" placeholder="サービス名" class="keyword"
                               value="{{ !empty($params['name']) ? $params['name'] : '' }}">
                        <button type="submit" class="search-btn">検索</button>
                    </form>
                </div>
                <div class="my-services">
                    @forelse($services as $service)
                        <div class="my-service">
                            <div class="left-img">
                                <img src="{{ $service->eye_catch_image_path }}" alt="サービス画像">
                            </div>
                            <div class="middle-txt">
                                <p>ID: {{ $service->id }}</p>
                                <p>
                                    <a href="{{ route('front.services.show', ['service' => $service]) }}" target="_blank">
                                        {{ $service->title }}
                                    </a>
                                </p>
                                @if ($service->is_invalid)
                                    <div class="status invalid">
                                        <p>無効</p>
                                    </div>
                                @else
                                    <div class="status">
                                        <p>有効</p>
                                    </div>
                                @endif
                            </div>
                            <div class="controls">
                                @if ($service->is_invalid)
                                    <a class="toggle-btn btn submit-btn" data-id="{{ $service->id }}">
                                        有効にする
                                    </a>
                                @else
                                    <a class="toggle-btn btn default-btn" data-id="{{ $service->id }}">
                                        無効にする
                                    </a>
                                @endif
                                <form action="{{ route('admin.services.toggle', ['service' => $service]) }}" method="post"
                                      id="toggle-form-{{ $service->id }}">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>まだサービスがありません</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $('.toggle-btn').click(function () {
                if (confirm('ステータスを更新してもよろしいですか？')) {
                    $('#toggle-form-' + $(this).data('id')).submit();
                }
            });
        });
    </script>
@endsection
