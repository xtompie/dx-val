<script>
var chat = chat || {};
chat.input = (function() {
    function submit() {
        let input = document.one('[chat-input]');
        let query = val.get(input).query;
        val.patch(input, {query: ''});
        chat.main.ask(query);
    }
    return {
        submit,
    }
})();
</script>