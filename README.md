# DX-VAL

DOM as a model using [DX](https://github.com/xtompie/dx) for getting, setting, rendering values.

```html
<div example>
    <div
        val
        val-set="(v) => this.textContent = v.title"
        val-get="() => {title: this.textContent}"
    >Foo</div>
</div>
<script>
val.set(document.one('[example]'), {title: 'Bar'}); // will change the DOM
console.log(val.get(document.one('[example]'))); // => {title: "Bar"}
</script>
```

Same can be done using fx. Predefined behaviours.

```html
<div example>
    <div val val-fx="text" val-key="title">Foo</div>
</div>
```

[Predefined fx](val.fx.php)
