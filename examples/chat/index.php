<!DOCTYPE html>
<html>
<body>
    <?php require 'js.index.php' ?>

    <button onclick="chat.main.minimize()">-</button>

    <div
        chat-conversation-list
        val="array" val-key="messages"
        style="max-height: 215px; overflow:scroll; background:lightgray;"
    ></div>

    <template val chat-conversation-item>
        <div val="object" val-key="question">
            <div val="date" val-key="time"></div>
            <div val="text" val-key="text"></div>
        </div>
        <div val="object" val-key="answer">
            <div val="date" val-key="time"></div>
            <div val="html" val-key="text"></div>
        </div>
    </template>

    <div chat-input>
        <div val val-set="(v) => { val.set(this, v); this.show(!v.loading); }" val-get="() => val.get(this)">
            <input type="text" val="input" val-key="query" placeholder="Type a message">
            <button onclick="chat.input.submit()">►</button>
        </div>
        <div val val-set="(v) => { val.set(this, v); this.show(v.loading); }">
            <input type="text" disabled="disabled">
            <button>...</button>
        </div>
    </div>


    <script>
        chat.main.init();
    </script>

</body>
</html>