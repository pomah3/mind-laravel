export function get_need_marks(mark, need, marks) {
    let mean = marks.mean();

    if (isNaN(mean))
        mean = 0;

    if (mean >= need)
        return 0;

    if (mark < need) {
        return Infinity;
    }

    let count = 0;
    while (true) {
        count++;

        if ((marks.length * mean + mark * count) / (count + marks.length) >= need)
            break;

        if (count > 1000) {
            count = Infinity;
            break;
        }
    }

    return count;
}
