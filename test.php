<style> body {display: none;} </style>
<?php require 'val.php' ?>
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
    function it(description, callback) {
        try {
            callback();
            console.log(`✅ ${description}`);
        } catch (error) {
            console.error(`❌ ${description}`);
            console.error(error.message);
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

<div>
    <div>
        <div val val-get="() => ({foo: this.textContent})">bar</div>
    </div>
    <script>
        it('should get value using val-get', function() {
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
        it('should set value using val-set', function() {
            let t = document.currentScript.up().one('div');
            val.set(t, {foo: 'baz'});
            expect(t.textContent.trim()).toBe('baz');
        });
    </script>
</div>

<div>
    <div>
        <div val="text" val-key="a">1</div>
        <div val="text" val-key="b">2</div>
    </div>
    <script>
        it('should patch value', function() {
            let t = document.currentScript.up().one('div');
            val.patch(t, {a: '3'});
            expect(val.get(t)).toBe({
                a: '3',
                b: '2',
            });
        });
    </script>
</div>
