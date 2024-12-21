<script>
var chat = chat || {};
chat.storage = chat.storage || {};
chat.storage.session = (function() {
    function key() {
        return 'chat.session';
    }
    function set(value) {
        localStorage.setItem(key(), value);
    }
    function get() {
        return localStorage.getItem(key());
    }
    function clear() {
        localStorage.removeItem(key());
    }
    return {
        set,
        get,
        clear,
    }
})();
</script>
