<?php require '../../val.php' ?>

<script>
let todo = (function(){
    function add(ctx) {
        val.modify(ctx.up('[todo]'), (data) => {
            data.items.push({text: data.add, status: 'todo'});
            data.add = '';
            return data;
        });
    }
    return {
        add,
    }
})();
</script>

<template todo-item-tpl>
    <div todo-item val="object">
        <input val="checkbox" val-key="status" val-check="done" val-uncheck="todo" type="checkbox" />
        <span val="text" val-key="text"></span>
        <button onclick="this.up('[todo-item]').remove()">remove</button>
    </div>
</template>

<div todo>
    <div val="array" val-key="items" val-tpl="[todo-item-tpl]"></div>
    <input val="input" val-key="add" type="text"/>
    <button  onclick="todo.add(this)">add</button>
</div>

<pre>
// run in console:
<code>val.get(document.one('[todo]'))</code>
</pre>