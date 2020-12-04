@extends('front.layouts.app')

@section('title', 'ユーザー管理 | てらぽーと')

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
                        <input type="search" name="name" placeholder="ユーザー名" class="keyword" value="{{ !empty($params['name']) ? $params['name'] : '' }}">
                        <button type="submit" class="search-btn">検索</button>
                    </form>
                </div>
                <div class="my-services">
                    @forelse($users as $user)
                        @if (!$user->is_admin)
                            <div class="my-service">
                                <div class="left-img">
                                    <img src="{{ $user->display_icon_image_path }}" alt="アイコン">
                                </div>
                                <div class="middle-txt">
                                    <p>ID: {{ $user->id }}</p>
                                    <p>
                                        <a href="{{ route('front.users.show', ['user' => $user]) }}" target="_blank">
                                            {{ $user->name }}
                                        </a>
                                    </p>
                                    @if ($user->is_invalid)
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
                                    @if ($user->is_invalid)
                                        <a class="toggle-btn btn submit-btn" data-id="{{ $user->id }}">
                                            有効にする
                                        </a>
                                    @else
                                        <a class="toggle-btn btn default-btn" data-id="{{ $user->id }}">
                                            無効にする
                                        </a>
                                    @endif
                                    <form action="{{ route('admin.users.toggle', ['user' => $user]) }}" method="post" id="toggle-form-{{ $user->id }}">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p>まだユーザーがいません</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('.toggle-btn').click (function() {
                if (confirm('ステータスを更新してもよろしいですか？')) {
                    $('#toggle-form-' + $(this).data('id')).submit();
                }
            });
        });
    </script>
@endsection
