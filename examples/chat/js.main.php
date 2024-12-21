<script>
var chat = chat || {};
chat.main = (function() {
    function init() {
        chat.loading.off();
        chat.conversation.addMessages(chat.storage.message.get());
    }
    function minimize() {
        window.parent.postMessage({ action: 'chat.close' }, '*')
    }
    function ask(question) {
        chat.loading.on();
        let message = {question: {text: question, time: now()}};
        chat.storage.message.add(message);
        chat.conversation.addMessage(message);
        chat.api
            .query({session: chat.storage.session.get(), question})
            .then(function(r) {
                let message = {answer: {text: r.message, time: now()}};
                chat.storage.message.add(message);
                chat.storage.session.set(r.session);
                chat.conversation.addMessage(message);
                chat.loading.off();
            })
        ;
    }
    function now() {
        return Math.floor(new Date().getTime() / 1000);
    }
    return {
        init,
        minimize,
        ask,
    }
})();
</script>