function insertAtCaret(areaId, text) {
    
    if (text == "macron") {
        text = '<span class="math-macron">A</span>';
    }
    
    if (text == "ul") {
        text = '<ul>\n<li></li>\n<li></li>\n<li></li>\n<li></li>\n<li></li>\n</ul>\n';
    }

    if (text == "table-header") {
        text = '<table>\n<tr>\n<th></th>\n<th></th>\n</tr>\n<tr>\n<td></td>\n<td></td>\n</tr>\n</table>\n';
    }

    if (text == "table-tools") {
        text = '<table class="tools">\n<tr><td></td><td></td></tr>\n<tr><td></td><td></td></tr>\n</table>\n';
    }

    if (text == "image") {
        text = '<img src="">\n';
    }

    if (text == "tab") {
        text = '\t';
    }

    if (text == "pretext") {
        text = '<pre class="pretext">\n\n</pre>\n';
    }

    if (text == "jumbo") {
        text = '<div class="jumbo"><h3></h3>\n\n</div>\n';
    }

    if (text == "info") {
        text = '<div class="info"></div>\n';
    }

    if (text == "frac") {
        text = '<span class="frac"><i>1</i><i>2</i></span>\n';
    }

    if (text == "lim") {
        text = '\\lim↙(x→∞) {}';
    }

    if (text == "sum") {
        text = '∑↙{k=0}↖{n} k = ';
    }

    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
            "ff" : (document.selection ? "ie" : false));
    if (br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        strPos = range.text.length;
    }
    else if (br == "ff")
        strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0, strPos);
    var back = (txtarea.value).substring(strPos, txtarea.value.length);
    txtarea.value = front + text + back;
    strPos = strPos + text.length;
    if (br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        range.moveStart('character', strPos);
        range.moveEnd('character', 0);
        range.select();
    }
    else if (br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}