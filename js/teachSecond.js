(function() {
    var addItem = document.getElementsByClassName('addItem')[0];
    var subItem = document.getElementsByClassName('subItem')[0];
    var count = document.getElementById('count');

    count.value = 2;
    console.log(count.value);

    addItem.onclick = function() {
        count.value++;
        console.log(count.value);
        var length = document.getElementsByClassName('form-group').length - 4;
        console.log(length);
        var numItem = 'a'.charCodeAt(0) + length;
        var charItem = String.fromCharCode(numItem).toUpperCase();
        var div = document.createElement('div');
        var divsec = document.createElement('div');
        var label = document.createElement('label');
        var input = document.createElement('input');
        div.setAttribute('class', 'form-group ' + charItem);
        label.setAttribute('class', 'col-sm-3 control-label');
        label.innerHTML = charItem;
        divsec.setAttribute('class', 'col-sm-9');
        input.setAttribute('class', 'form-control');
        input.setAttribute('name', ++length);
        divsec.appendChild(input);
        div.appendChild(label);
        div.appendChild(divsec);
        $(div).insertBefore($('.center'));
    }
    subItem.onclick = function() {
        console.log(22);
        var length = document.getElementsByClassName('form-group').length - 5;
        console.log(length);
        if (length > 1) {
            count.value--;
            var numItem = 'a'.charCodeAt(0) + length;
            var charItem = String.fromCharCode(numItem).toUpperCase();
            console.log(charItem);
            $('.' + charItem).remove();
        }
    }
})()