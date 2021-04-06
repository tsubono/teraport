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
                {{ str_replace('<br>', ' ', $category->name) }}
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
    <label for="price">お布施</label>
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
    <label for="request_for_purchase">利用にあたってのお願い</label>
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


<div class="form-group">
    <div class="terms-area mb-30">
    {!! nl2br(e("サービスの提供及び支払いに関する注意事項

    1. 提供者は所轄庁に宗教法人として認可されている寺院又は当該寺院に在籍する僧侶のみとします。
    2. サービスの提供登録をする場合、実名欄には必ず所属する寺院名又は実名又は所属教団に登録されている僧名を開示しなければなりません。プロフィールにも同様の情報を開示して下さい。
    3. サービスの提供登録は無料とします。提供者はカテゴリとマッチするサービスを登録し、提供者自身でサービスに対するお布施代金を決めて下さい。（墓地及びフリーマーケットも同様とします）
    4. サービスの利用者並びに提供者は、サービスの提供及び利用完了時において、お互いの対応について評価を付けますので、責任のある対応を心掛けて下さい。
    5. 提供者からのサービスを利用する場合、利用者は当サイト所定のフォームより手続を行い、手続が完了した時点で「サービス提供契約」が成立します。
    6. 止むを得ない理由で提供者又は利用者が契約をキャンセルする場合は、必ずキャンセル手続（相手方への申請と承諾）をとり、トラブルの無いよう誠実な対応を心掛けて下さい。尚、キャンセル手続が成立した場合、提供者及び利用者双方とも評価は付けることができなくなります。
    7. 当サイト運営者は、提供サービスの品質及び内容（提供者、布施額、写真等を含みます。）について審査を行います。利用規約に違反のある場合はサービスの提供を取り消す場合があります。
    8. 利用者によるお布施の支払いは当サイト運営者に行われます。尚、契約の成立後に所定のキャンセル手続きが行われた場合、当サイト運営者は利用者に対してお布施代金の返金手続きを行います。
    9. 提供者はサービスの提供が完了した後、所定の期間内に当サイト運営者に対して振込申請を行ないます。当サイト運営者は振込み申請が行われた月の翌月末に、提供者所定の登録銀行口座に振り込むものとします。
    10. 提供者は、サイト運営者に対し事務手数料として代金相当額に10%の手数料率を乗じた金額を支払うこととします。事務手数料の支払いは、振込申請日時点での代金相当額の総額から、手数料及び所定の銀行振込手数料を差し引いた金額を、振込金額として確定する方法により行います。
    11. 当サイトサービスを介して問い合わせ、申込み及びその他接触を持つに至った利用会員との間で、又は当サイトサービスにより知り得た利用会員の個人情報を利用して、現に提供している又は提供が可能なサービスについて当サイトサービスを介さずに直接取引をする行為及び直接取引を誘引又は誘引に応じる行為を固く禁じます。
    12. 提供者によるサービスに以下の内容が含まれる場合、当サイト運営者の判断により当該サービスの削除及び提供者資格を取り消すことができるものとします。
    ・法令又は公序良俗に反する内容を含む場合
    ・特定の団体又は個人を非難又は誹謗中傷する内容を含む場合
    ・政治的思想を含む場合、特定宗教教団への強引な勧誘を含む場合
    ・利用者の目的と合致しない情報を提供する行為
    ・利用会員に対し誤解、不安、恐怖、損害等を与える恐れのある情報を含む場合
    ・利用会員に対し直接の面会を要求又は強要する行為

    尚、当サイト運営者は、サービス提供契約の当事者となるものではなく、サービス提供契約につき、提供者又は利用者のいずれの立場に関する責任も負いませんのご注意下さい。
    ")) !!}
    </div>
</div>

