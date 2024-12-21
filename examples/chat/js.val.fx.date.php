<script>
var val = val || {};
val.fx = val.fx || {};
val.fx.date = {
    get: (el) => {
        const key = el.attr('val-key');
        if (!key) return null;

        const dateString = el.textContent;
        if (!dateString || typeof dateString !== 'string') return null;

        const dateParts = dateString.split(' ');
        if (dateParts.length !== 2) return null;

        const [datePart, timePart] = dateParts;

        const dayMonthYear = datePart.split('.');
        if (dayMonthYear.length !== 3) return null;
        const [day, month, year] = dayMonthYear.map(Number);

        const hoursMinutesSeconds = timePart.split(':');
        if (hoursMinutesSeconds.length !== 3) return null;
        const [hours, minutes, seconds] = hoursMinutesSeconds.map(Number);

        if (isNaN(day) || isNaN(month) || isNaN(year) || isNaN(hours) || isNaN(minutes) || isNaN(seconds)) {
            return null;
        }

        const timestamp = Math.floor(new Date(year, month - 1, day, hours, minutes, seconds).getTime() / 1000);
        return { [key]: timestamp };
    },
    set: (el, data) => {
        const key = el.attr('val-key');
        if (!key) {
            el.textContent = '';
            return;
        }

        const timestamp = data[key];
        if (typeof timestamp !== 'number') {
            el.textContent = '';
            return;
        }

        const date = new Date(timestamp * 1000);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        el.textContent = `${day}.${month}.${year} ${hours}:${minutes}:${seconds}`;
    }
};
</script>
