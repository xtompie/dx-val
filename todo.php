<?php require 'val.php' ?>

<script>
let todo = (function(){
    function add(ctx) {
        let space = ctx.up('[todo]');
        data = val.get(space);
        data.items.push({text: data.add, status: 'todo'});
        data.add = '';
        val.set(space, data);
        output(space);
    }
    function check(ctx) {
        output(ctx.up('[todo]'));
    }
    function remove(ctx) {
        ctx.up('[todo-item]').remove();
        output(ctx.up('[todo]'));
    }
    function output(space) {
        space.one('[todo-output]').textContent = JSON.stringify(val.get(space).items, null, 4);
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
    <div val val-fx="array" val-key="items" val-tpl="[todo-item-tpl]">
    </div>
    <div>
        <input type="text" val val-fx="input" val-key="add" />
        <button onclick="todo.add(this)">add</button>
    </div>
    <pre todo-output></pre>
</div>