# DX-VAL

DOM as a model. Getting, setting values. Rendering engine. Using [DX](https://github.com/xtompie/dx).

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
    <div val="text" val-key="title">Foo</div>
</div>
```

[Predefined fx](val.fx.php)

## Examples

- [Example Todo](example-todo.php)
- [Test](test.php)

To run examples execute `composer serve`
