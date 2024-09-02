window.finalEnlishToBanglaNumber = {
    0: "০",
    1: "১",
    2: "২",
    3: "৩",
    4: "৪",
    5: "৫",
    6: "৬",
    7: "৭",
    8: "৮",
    9: "৯",
};

String.prototype.enToBn = function () {
    var retStr = this;
    for (var x in finalEnlishToBanglaNumber) {
        retStr = retStr.replace(
            new RegExp(x, "g"),
            finalEnlishToBanglaNumber[x]
        );
    }
    return retStr;
};
