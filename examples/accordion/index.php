<?php require '../../val.php' ?>

<div accordion>
    <div accordion-item>
        <div onclick="val.set(this.up('[accordion]'), {open: '1'})">1</div>
        <div val="if" val-key="open" val-value="1">Content1</div>
    </div>
    <div accordion-item>
        <div onclick="val.set(this.up('[accordion]'), {open: '2'})">2</div>
        <div val="if" val-key="open" val-value="2">Content2</div>
    </div>
    <script>
        val.set(
            document.currentScript.up('accordion'),
            {open: '1'}
        );
    </script>
</div>
