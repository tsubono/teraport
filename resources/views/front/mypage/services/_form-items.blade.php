<div class="form-group">
    <label for="title">タイトル</label>
    <input id="title" type="text" name="title" value="{{ old('title', $service->title) }}">

    @error('title')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="price">カテゴリ</label>
    <select name="category_id">
        <option value="">選択してください</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) === $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="content">内容</label>
    <textarea name="content" rows="10">{{ old('content', $service->content) }}</textarea>

    @error('content')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="price">金額</label>
    <input id="price" type="number" name="price" value="{{ old('price', $service->price) }}">

    @error('price')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="price">画像1</label>
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.0', !empty($service->images[0]) ? $service->images[0]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded_images/service'"></drop-image>
</div>

<div class="form-group">
    <label for="price">画像2</label>
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.1', !empty($service->images[1]) ? $service->images[1]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded_images/service'"></drop-image>
</div>

<div class="form-group">
    <label for="price">画像3</label>
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.2', !empty($service->images[2]) ? $service->images[2]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded_images/service'"></drop-image>
</div>

<div class="form-group">
    <label for="request_for_purchase">購入にあたってのお願い</label>
    <textarea name="request_for_purchase" rows="10">{{ old('request_for_purchase', $service->request_for_purchase) }}</textarea>

    @error('request_for_purchase')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="price">公開 / 非公開</label>
    <select name="is_public">
        <option value="1" {{ old('is_public', !empty($service->id) ? $service->is_public : 1) == 1 ? 'selected' : '' }}>公開</option>
        <option value="" {{ old('is_public', !empty($service->id) ? $service->is_public : 1) == '' ? 'selected' : '' }}>非公開</option>
    </select>
</div>

<div class="form-group">
    <label for="real_name">実名</label>
    <input id="real_name" type="text" name="real_name" value="{{ old('real_name', auth()->user()->real_name) }}">

    @error('real_name')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>


