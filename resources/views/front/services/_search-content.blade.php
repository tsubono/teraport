<div class="free-word-search">
    <h3>フリーワード検索</h3>
    <form>
        <input type="hidden" name="c" value="{{ !empty($params['c']) ?? $params['c'] }}">
        <input type="search" name="keyword" placeholder="検索キーワードを入力" class="keyword" value="{{ !empty($params['keyword']) ? $params['keyword'] : '' }}">
        <button type="submit" class="search-btn">検索</button>
    </form>
</div>
<div class="category-search">
    <h3>カテゴリから探す</h3>
    <ul>
        @foreach ($categories as $category)
            <li class="{{ (!empty($params['c']) ? $params['c'] : '') == $category->id ? 'active' : '' }}">
                <a href="{{ route('front.services.index') }}?c={{ $category->id }}{{ !empty($params['keyword']) ? '&keyword='. $params['keyword'] : '' }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
