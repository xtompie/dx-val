<script>
var chat = chat || {};
chat.storage = chat.storage || {};
chat.storage.message = (function() {
    function key() {
        return 'chat.messages';
    }
    function get() {
        return JSON.parse(localStorage.getItem(key())) || [];
    }
    function add(item) {
        let messages = get();
        messages.push(item);
        localStorage.setItem(key(), JSON.stringify(messages));
    }
    function clear() {
        localStorage.removeItem(key());
    }
    return {
        get,
        add,
        clear,
    }
})();
</script>
