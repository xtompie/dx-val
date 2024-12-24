
<?php require '../val.php' ?>
<script>
    function deepEqual(obj1, obj2) {
        if (obj1 === obj2) return true;
        if (typeof obj1 !== "object" || typeof obj2 !== "object" || obj1 === null || obj2 === null) {
            return false;
        }
        const keys1 = Object.keys(obj1);
        const keys2 = Object.keys(obj2);
        if (keys1.length !== keys2.length) return false;
        for (let key of keys1) {
            if (!keys2.includes(key) || !deepEqual(obj1[key], obj2[key])) {
                return false;
            }
        }
        return true;
    }
    function test(description, callback) {
        try {
            callback();
            console.log(`✅ ${description}`);
        } catch (error) {
            console.error(`❌ ${description}: ${error.message}`);
        }
    }
    function expect(value) {
        return {
            toBe(expected) {
                if (!deepEqual(value, expected)) {
                    throw new Error(`Expected ${JSON.stringify(value)} to be ${JSON.stringify(expected)}`);
                }
            },
        };
    }
</script>

<pre>see console for test result</pre>

<section style="display: none;">

<div>
    <div>
        <div val="text" val-key="a">1</div>
    </div>
    <script>
        test('val.obj get', function() {
            let t = document.currentScript.up().one('div');
            expect(val.obj(t)).toBe({a: '1'});
        });
    </script>
</div>

<div>
    <div>
        <div val="text" val-key="a"></div>
    </div>
    <script>
        test('val.obj set', function() {
            let t = document.currentScript.up().one('div');
            val.obj(t, {a: '2'});
            expect(t.one('div').textContent).toBe('2');
        });
    </script>
</div>

<div>
    <div>
    </div>
    <template>
        <div val="object">
            <div val="text" val-key="a"></div>
        </div>
    </template>
    <script>
        test('val.render', function() {
            let div = document.currentScript.up().one('div');
            let tpl = document.currentScript.up().one('template');
            val.render(div, tpl, {a: '2'});
            expect(div.one('div').one('div').textContent).toBe('2');
        });
    </script>
</div>

<div>
    <div>
        <div val="object">
            <div val="text" val-key="a"></div>
        </div>
    </div>
    <template>
        <div val="object">
            <div val="text" val-key="a"></div>
        </div>
    </template>
    <script>
        test('val.render null', function() {
            let div = document.currentScript.up().one('div');
            let tpl = document.currentScript.up().one('template');
            val.render(div, tpl, null);
            expect(div.children.length).toBe(0);
        });
    </script>
</div>

<div>
    <div>
        <div val="object">
            <div val="text" val-key="a">3</div>
        </div>
    </div>
    <template>
        <div val="object">
            <div val="text" val-key="a"></div>
        </div>
    </template>
    <script>
        test('val.arr', function() {
            let div = document.currentScript.up().one('div');
            let tpl = document.currentScript.up().one('template');
            val.arr(div, tpl, [{a: '1'}, {a: '2'}]);
            expect(div.children.length).toBe(2);
        });
    </script>
</div>

<div>
    <div>
        <div val="object">
            <div val="text" val-key="a">3</div>
        </div>
    </div>
    <template>
        <div val="object">
                <div val="text" val-key="a">3</div>
            </div>
        </template>
    <script>
        test('val.arr empty', function() {
            let div = document.currentScript.up().one('div');
            let tpl = document.currentScript.up().one('template');
            val.arr(div, tpl, []);
            expect(div.children.length).toBe(0);
        });
    </script>
</div>

<div>
    <div>
        <div val="text" val-key="a">1</div>
        <div val="text" val-key="b">2</div>
    </div>
    <script>
        test('val.patch', function() {
            let t = document.currentScript.up().one('div');
            val.patch(t, {a: '3'});
            expect(val.get(t)).toBe({
                a: '3',
                b: '2',
            });
        });
    </script>
</div>

<div>
    <div>
        <div val="text" val-key="a">4</div>
    </div>
    <script>
        test('val.modify', function() {
            let t = document.currentScript.up().one('div');
            val.modify(t, (d) => {
                d.a = '3';
                return d;
            });
            expect(t.one('div').textContent).toBe('3');
        });
    </script>
</div>

<div>
    <div>
        <div val="object">
            <div val="text" val-key="a">1</div>
        </div>
    </div>
    <template>
        <div val="object">
            <div val="text" val-key="a"></div>
        </div>
    </template>
    <script>
        test('val.append', function() {
            let div = document.currentScript.up().one('div');
            let tpl = document.currentScript.up().one('template');
            val.append(div, tpl, [{a: '2'}, {a: '3'}]);
            expect(div.children.length).toBe(3);
        });
    </script>
</div>

<div>
    <div>
        <div val val-get="() => ({foo: this.textContent})">bar</div>
    </div>
    <script>
        test('val-get', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({
                foo: 'bar'
            });
        });
    </script>
</div>

<div>
    <div>
        <span val val-set="(v) => this.textContent = v.foo">bar</span>
    </div>
    <script>
        test('val-set', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {foo: 'baz'});
            expect(t.one('span').textContent).toBe('baz');
        });
    </script>
</div>

<div>
    <div>
        <div val="text" val-key="a">1</div>
    </div>
    <script>
        test('fx text get', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: '1'});
        });
    </script>
</div>

<div>
    <div>
        <div val="text" val-key="a"></div>
    </div>
    <script>
        test('fx text set', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: '2'});
            expect(t.one('div').textContent).toBe('2');
        });
    </script>
</div>

<div>
    <div>
        <div val="html" val-key="a"><b>1</b></div>
    </div>
    <script>
        test('fx html get', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: '<b>1</b>'});
        });
    </script>
</div>

<div>
    <div>
        <input val="input" val-key="a" value="1" />
    </div>
    <script>
        test('fx input get', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: '1'});
        });
    </script>
</div>

<div>
    <div>
        <input val="input" val-key="a" value="1" />
    </div>
    <script>
        test('fx input set', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: '2'});
            expect(t.one('input').value).toBe('2');
        });
    </script>
</div>

<div>
    <div>
        <div val="show" val-key="a"></div>
    </div>
    <script>
        test('fx show get visible', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: true});
        });
    </script>
</div>

<div>
    <div>
        <div val="show" val-key="a" style="display: none;"></div>
    </div>
    <script>
        test('fx show get hidden', function() {
            let t = document.currentScript.up().one('div');
            expect(t.one('div').style.display).toBe('none');
        });
    </script>
</div>

<div>
    <div>
        <div val="show" val-key="a"></div>
    </div>
    <script>
        test('fx show set visible', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: true});
            expect(t.one('div').style.display).toBe('');
        });
    </script>
</div>

<div>
    <div>
        <div val="show" val-key="a"></div>
    </div>
    <script>
        test('fx show set hidden', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: false});
            expect(t.one('div').style.display).toBe('none');
        });
    </script>
</div>

<div>
    <div>
        <img val="img" val-key="a" src="http://example.com/img.jpg" />
    </div>
    <script>
        test('fx img get', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: 'http://example.com/img.jpg'});
        });
    </script>
</div>

<div>
    <div>
        <img val="img" val-key="a" src="http://example.com/img.jpg" />
    </div>
    <script>
        test('fx img set', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: 'http://example.com/img2.jpg'});
            expect(t.one('img').src).toBe('http://example.com/img2.jpg');
        });
    </script>
</div>

<div>
    <div>
        <div val="attr" val-key="a" val-attr="data-foo" data-foo="1"></div>
    </div>
    <script>
        test('fx attr get', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: '1'});
        });
    </script>
</div>

<div>
    <div>
        <div val="attr" val-key="a" val-attr="data-foo" data-foo="1"></div>
    </div>
    <script>
        test('fx attr set', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: '2'});
            expect(t.one('div').attr('data-foo')).toBe('2');
        });
    </script>
</div>

<div>
    <div>
        <input val="checkbox" val-key="a" val-check="1" val-uncheck="0" checked />
    </div>
    <script>
        test('fx checkbox get checked', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: '1'});
        });
    </script>
</div>

<div>
    <div>
        <input val="checkbox" val-key="a" val-check="1" val-uncheck="0" />
    </div>
    <script>
        test('fx checkbox get unchecked', function() {
            let t = document.currentScript.up().one('div');
            expect(val.get(t)).toBe({a: '0'});
        });
    </script>
</div>

<div>
    <div>
        <input val="checkbox" val-key="a" val-check="1" val-uncheck="0" />
    </div>
    <script>
        test('fx checkbox set checked', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: '1'});
            expect(t.one('input').checked).toBe(true);
        });
    </script>
</div>

<div>
    <div>
        <input val="checkbox" val-key="a" val-check="1" val-uncheck="0" />
    </div>
    <script>
        test('fx checkbox set unchecked', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {a: '0'});
            expect(t.one('input').checked).toBe(false);
        });
    </script>
</div>

</section>