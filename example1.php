<?php require 'val.php' ?>

<template item>
    <div
        style="background-color: green;"
        val="object"
    >
        <div val="text" val-key="desc"></div>
        <div val="text" val-key="desc2"></div>
    </div>
</template>

<template error>
    <div val="object">
        <div val="text" val-key="text"></div>
    </div>
</template>

<div example>

    <div
        style="background-color: yellow;"
        val="text" val-key="title"
    >Hello, World!</div>

    <div
        style="background-color: red;"
        val="render" val-key="error" val-tpl="[error]"
    >
        <div val="text" val-key="text">Error!</div>
    </div>

    <div
        items
        style="background-color: blue; padding: 10px;"
        val="array" val-key="items" val-tpl="[item]"
    >
    </div>

    <input type="text" val="input" val-key="message" value="Hi!">

    <select val="input" val-key="color">
        <option value="red">Red</option>
        <option value="green" selected="selected">Green</option>
        <option value="blue">Blue</option>
    </select>

    <div val="show" val-key="a" style="display: none;">Aaa</div>
    <div val="hide" val-key="b">Baa</div>
    <img src="https://via.placeholder.com/150" val="img" val-key="img"  />
    <span val="attr" val-key="status" val-attr="status" status="open"></span>
    <div val="if" val-key="foo" val-value="bar">foo == bar</div>

</div>
