<?php require 'val.php' ?>

<script>
let todo = (function(){
    function add(ctx) {
        val.modify(ctx.up('[todo]'), (data) => {
            data.items.push({text: data.add, status: 'todo'});
            data.add = '';
            return data;
        });
        ctx.up('[todo]').one('[todo-add]').focus();
        output(ctx);
    }
    function check(ctx) {
        output(ctx);
    }
    function remove(ctx) {
        ctx.up('[todo-item]').remove();
        output(ctx);
    }
    function output(ctx) {
        let space = ctx.up('[todo]');
        space.one('[todo-output]').textContent = JSON.stringify(val.get(space), null, 4);
    }
    return {
        add,
        check,
        remove,
    }
})();
</script>

<template todo-item-tpl>
    <div todo-item val val-fx="object">
        <input
            val val-fx="checkbox" val-key="status" val-check="done" val-uncheck="todo"
            type="checkbox" onchange="todo.check(this)"
        />
        <span val val-fx="text" val-key="text"></span>
        <button onclick="todo.remove(this)">remove</button>
    </div>
</template>

<div todo>

    <div val val-fx="array" val-key="items" val-tpl="[todo-item-tpl]"></div>

    <div>
        <input
            todo-add
            val val-fx="input" val-key="add"
            type="text"
        />
        <button  onclick="todo.add(this)">add</button>
    </div>

    <pre todo-output></pre>

</div>

<script>
    document.one('[todo]').one('[todo-add]').focus();
</script>