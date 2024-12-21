<script>
var chat = chat || {};
chat.conversation = (function() {
    function list() {
        return document.one('[chat-conversation-list]');
    }
    function addMessage(message) {
        val.append(list(), '[chat-conversation-item]', [message]);
        list().scrollTop = list().scrollHeight;
    }
    function clear() {
        val.set(list(), null);
    }
    function addMessages(messages) {
        messages.each(addMessage);
    }
    return {
        addMessage,
        clear,
        addMessages,
    }
})();
</script>