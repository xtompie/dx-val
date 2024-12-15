<?php require 'val.php' ?>

<template item>
    <div
        style="background-color: green;"
        val val-fx="object"
    >
        <div val val-fx="text" val-key="desc"></div>
        <div val val-fx="text" val-key="desc2"></div>
    </div>
</template>

<template error>
    <div val val-fx="text" val-key="text"></div>
</template>

<div example>

    <div
        style="background-color: yellow;"
        val val-fx="text" val-key="title"
    >Hello, World!</div>

    <div
        style="background-color: red;"
        val val-fx="render" val-key="error" val-tpl="[error]"
    >
        <div val val-fx="text" val-key="text">Error!</div>
    </div>

    <div
        style="background-color: blue; padding: 10px;"
        val val-fx="array" val-key="items" val-tpl="[item]"
    >
    </div>

    <input type="text" val val-fx="input" val-key="message" value="Hi!">

    <select val val-fx="input" val-key="color">
        <option value="red">Red</option>
        <option value="green" selected="selected">Green</option>
        <option value="blue">Blue</option>
    </select>

    <div val val-fx="show" val-key="a" style="display: none;">Aaa</div>
    <div val val-fx="hide" val-key="b">Baa</div>
    <img src="https://via.placeholder.com/150" val val-fx="img" val-key="img"  />
    <span val val-fx="attr" val-key="status" val-attr="status" status="open"></span>
    <div val val-fx="if" val-key="foo" val-value="bar">foo == bar</div>

</div>
