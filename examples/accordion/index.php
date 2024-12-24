<?php require '../../val.php' ?>

<div accordion>
    <div>
        <div onclick="val.set(this.up('[accordion]'), {active: '1'})">1</div>
        <div val="if" val-key="active" val-value="1">Content1</div>
    </div>
    <div>
        <div onclick="val.set(this.up('[accordion]'), {active: '2'})">2</div>
        <div val="if" val-key="active" val-value="2">Content2</div>
    </div>
    <script>
        val.set(
            document.currentScript.up('accordion'),
            {active: '1'}
        );
    </script>
</div>
