(function() {
    var teaId = document.getElementById('teaId');
    var teaName = document.getElementById('teaName');
    var pass = document.getElementById('password');
    var conPass = document.getElementById('confirm-password');
    var subject = document.getElementById('subject');
    if (teaId.value) {
        if (teaName.value) {
            if (pass.value == conPass.value) {
                $('#register-form').submit();
            } else {
                alert("两次输入密码不一致");
                conPass.value = '';
            }
        }
    }

    function getteaId(data) {
        console.log(data);
        cookie.setCookie('teaId', data, 1);
    }

    function move(name) {
        console.log(name);
        var sel = document.getElementsByClassName('sel')[0];
        var inner = name;
        sel.innerHTML = inner;
        subject.value = inner;

        console.log(cookie);
        cookie.setCookie('subject', inner, 1);
    }

    function keyUp(value) {
        console.log(value);
        $.get(`php/teaRegisterCheck.php?teaId=${value}`, function(data) {
            if (data == 0) {
                alert('该职工号已存在');
                stuId.value = '';
            }
        })
    }
})()