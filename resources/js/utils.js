Array.prototype.unique = function() {
    var o = {}, a = [], i, e;
    for (i = 0; e = this[i]; i++) {o[e] = 1};
    for (e in o) {a.push (e)};
    return a;
}

Array.prototype.mean = function() {
    if (this.length == 0)
        return 0;

    let sum = this.reduce((a,b) => a+b);
    return sum/this.length;
}
