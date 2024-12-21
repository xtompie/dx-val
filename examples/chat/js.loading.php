<script>
var chat = chat || {};
chat.loading = (function() {
    function on() {
        val.patch(document.one('[chat-input]'), {loading: true});
    }
    function off() {
        val.patch(document.one('[chat-input]'), {loading: false});
    }
    return {
        on,
        off,
    }
})();
</script>