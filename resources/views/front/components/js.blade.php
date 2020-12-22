<script src="{{ secure_asset('asset/js/jquery-3.5.1.min.js') }}"></script>
@if (!request()->is('services/*'))
    <script src="{{ secure_asset('js/app.js') }}"></script>
@endif
<script>
    $(function() {
        /**
         * お知らせポップアップ
         */
        $('.notification-popup').click (function(e) {
            e.stopPropagation();

            if ($('.notification-messages').css('display') === 'block') {
                $('.notification-messages').fadeOut();
            } else {
                $('.notification-messages').fadeIn();
            }
        });

        $('body').click (function(e) {
            if( $(e.target).closest(".check-all-messages").length > 0 ) {
                return true;
            }

            if( $(e.target).closest(".notification-messages").length > 0 ) {
                return false;
            }

            if ($('.notification-messages').css('display') === 'block') {
                $('.notification-messages').fadeOut();
            }
        });

        /**
         * メッセージバリデーション
         */
        $(function() {
            $('.send-btn').click (function() {
                if (!check()) {
                    return false;
                }
                document.sendForm.submit();
            });
        });

        /**
         * 入力値をチェックする
         * @returns {boolean}
         */
        function check()
        {
            let check = true;
            if ($('[name=content]').val() === '') {
                $('#error-text strong').text('本文を入力してください');
                check = false;
            }
            // 文字サイズチェック
            let textareValue = document.sendForm.content.value;
            let wordNumber = textareValue.length;
            if (wordNumber > 10000) {
                $('#error-text strong').text('10,000文字以内で入力してください');
                check = false;
            }

            // ファイルサイズチェック
            let totalSize = 0;
            $('input[type=file]').each(function(){
                if($(this).val()){
                    let file = $(this).prop('files')[0];
                    totalSize = totalSize + file.size;
                }
            });

            if(totalSize > 8000000){
                $('#error-file strong').text('一度にアップロードできる画像サイズの容量を超えました');
                $(this).val('');
                check = false;
            }

            return check;
        }

        /**
         * 必須チェックボックス
         */
        $('.require-check').change (function() {
            $('.submit-btn').prop('disabled', !$(this).prop('checked'));
        });

        /**
         * ポップアップ
         */
        $('.js-popup-open').on('click',function(){
            $('#' + $(this).data('id')).fadeIn();
            return false;
        });

        $('.js-popup-close').on('click',function(){
            $(this).parents('.js-popup').fadeOut();
            return false;
        });

        /**
         * 利用するボタン
         * @type {boolean}
         */
        if ($('.stripe-button-el').length !== 0) {
            $('.stripe-button-el')[0].disabled = true;
        }
        $('.require-check-stripe').change (function() {
            $('.stripe-button-el').prop('disabled', !$(this).prop('checked'));
        });

        /**
         * サイドバー
         */
        $('#nav-open').on("click", function() {
            $('body').addClass('fixed');
        });
        $('#close, #nav-close').on("click", function() {
            $('body').removeClass('fixed');
        });
    });
</script>

@yield('script')
