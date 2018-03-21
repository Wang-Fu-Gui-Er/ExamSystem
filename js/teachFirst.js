$(function() {
    var insertP = $('.insertP');
    var subject, teaId;
    var search = document.getElementById('search');
    document.cookie.split(";").forEach(function(item) {
        var num = item.split('=');
        console.log(num);
        if (num[0] == ' subject') {
            subject = num[1];
        }
        if (num[0] == ' teaId') {
            teaId = num[1];
        }
    })
    console.log(subject + '' + teaId);
    var content;
    $.get(`./php/teacherController.php?teaId=${teaId}&subject=${subject}`, function(data) {
        // console.log(222)
        data = JSON.parse(data);
        console.log(data);
        data.forEach(function(item) {
            content = `<li><span>${item[0]}</span><span>${item[1]}</span><span>${item[2]}</span><span>${item[3]}</span></li>`;

            console.log(content);
            $(content).insertAfter(insertP);
        })
    })

    search.onkeyup = function() {
        // console.log()
        $(insertP).nextAll().detach();
        var re = /^[0-9]+.?[0-9]*$/;
        var val = search.value;
        if (re.test(val)) {
            $.get('php/queryLike.php', {
                "stuNo": val,
                "stuScore": val
            }, function(data) {
                if (data != 0) {
                    data = JSON.parse(data);
                    data.forEach(function(item) {
                        content = `<li><span>${item[0]}</span><span>${item[1]}</span><span>${item[3]}</span><span>${item[2]}</span></li>`;
                        $(content).insertAfter(insertP);
                    })
                }
            })
        } else {
            console.log(222);
            $.get('php/queryLike.php', {
                "stuName": val
            }, function(data) {
                if (data != 0) {
                    data = JSON.parse(data);
                    data.forEach(function(item) {
                        content = `<li><span>${item[0]}</span><span>${item[1]}</span><span>${item[3]}</span><span>${item[2]}</span></li>`;
                        $(content).insertAfter(insertP);
                    })
                }
            })
        }
    }

})