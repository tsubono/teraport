<div class="notification-messages" style="display: none">
    @forelse(auth()->user()->notifications as $index => $notification)
        <div class="message {{ is_null($notification->read_at) ? 'un-read' : '' }}">
            <div class="title">
                <p>{{ $notification->data['title'] }}</p>
            </div>
            <div class="txt">
                {!! nl2br(e(Str::limit($notification->data['body'], 50))) !!}
            </div>
            <a class="check-message" onclick="document.getElementById('notifyForm-{{ $index }}').submit()">
                <p>確認する</p>
            </a>
            <form action="{{ route('front.notifications.read', ['notification' => $notification]) }}" method="post" id="notifyForm-{{ $index }}">
                @csrf
            </form>
        </div>
    @empty
        <p>まだ通知はありません</p>
    @endforelse

    @if (auth()->user()->notifications->count() !== 0)
        <a class="check-all-messages" href="{{ route('front.notifications.index') }}">
            全てのお知らせを見る
        </a>
    @endif
</div>
