<?php require_once 'util.php' ?>
<?php require_once 'val.fx.php' ?>
<script>
var val = (function (val) {
    function obj(el, data) {
        if (arguments.length === 1) {
            let d = el.allfd('[val]').reduce((r, e) => r.merge(_get(e)), {});
            return Object.keys(d).length === 0 ? null : d;
        } else {
            if (data === null || data === undefined) {
                el.remove();
                return;
            }
            el.allfd('[val]').each(e => _set(e, data));
        }
    };
    function arr(el, tpl, data) {
        if (arguments.length === 1) {
            return el.allfd('[val]').map(_get);
        } else {
            if (data === null || data.length === 0) {
                return;
            }
            el.innerHTML = '';
            tpl = (typeof tpl === 'string') ? document.one(tpl) : tpl;
            data.each(d => {
                let frag = tpl.tpl();
                obj(frag, d);
                el.appendChild(frag);
            });
        }
    }
    function render(el, tpl, data) {
        el.innerHTML = '';
        if (data === undefined || data === null) {
            return;
        }
        tpl = (typeof tpl === 'string') ? document.one(tpl) : tpl;
        el.innerHTML = '';
        let frag = tpl.tpl();
        obj(frag, data);
        el.appendChild(frag);
    }
    function append(el, tpl, data) {
        tpl = (typeof tpl === 'string') ? document.one(tpl) : tpl;
        data.each(d => {
            let frag = tpl.tpl();
            obj(frag, d);
            el.appendChild(frag);
        });
    }
    function prepend(el, tpl, data) {
        tpl = (typeof tpl === 'string') ? document.one(tpl) : tpl;
        data.reverse().each(d => {
            let frag = tpl.tpl();
            obj(frag, d);
            el.prepend(frag);
        });
    }
    function patch(el, data) {
        obj(el, obj(el).merge(data));
    }
    function set(el, data) {
        obj(el, data);
    }
    function get(el) {
        return obj(el);
    }
    function _get(el) {
        let data = {};
        let fx = el.attr('val-fx');
        if (fx !== null && fx in val.fx) {
            data = data.merge(val.fx[fx].get(el));
        }
        let fget = el.attr('val-get');
        if (fget !== null) {
            Object.assign(data, (function () { return eval(fget).call(); }).bind(el)());
        }
        return data;
    }
    function _set(el, v) {
        let fx = el.attr('val-fx');
        if (fx !== null && fx in val.fx) {
            val.fx[fx].set(el, v);
        }
        let fset = el.attr('val-set');
        if (fset !== null) {
            (function () { return eval(fset).call(el, v); }).bind(el)();
        }
    }
    if (typeof val.fx === 'undefined') {
        val.fx = {};
    }
    return val.merge({
        arr,
        get,
        obj,
        patch,
        render,
        prepend,
        append,
        set,
    });
})(val || {});
</script>