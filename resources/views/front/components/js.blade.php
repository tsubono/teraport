<script src="{{ asset('asset/js/jquery-3.5.1.min.js') }}"></script>
@if (!request()->is('services/*'))
    <script src="{{ asset('js/app.js') }}"></script>
@endif
<script>
    $(function() {
        $('.notification-popup').click (function(e) {
            e.stopPropagation();

            if ($('.notification-messages').css('display') === 'block') {
                $('.notification-messages').fadeOut();
            } else {
                $('.notification-messages').fadeIn();
            }
        });

        $('body').click (function(e) {
            if( $(e.target).closest(".notification-messages").length > 0 ) {
                return false;
            }

            if ($('.notification-messages').css('display') === 'block') {
                $('.notification-messages').fadeOut();
            }
        });
    });
</script>

@yield('script')
