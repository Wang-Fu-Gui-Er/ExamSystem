(function() {
    function show(id) {
        // console.log(id);

        var spanId = $(`#${id}`).parent();

        console.log(spanId.attr('class'));

        if (spanId.hasClass('active')) {
            var next = spanId.next();
            console.log(next);
            // next.addClass('hidden');
            next.detach();
            spanId.removeClass('active');
        } else {
            var li = document.createElement('li');
            var span = document.createElement('span');
            var span1 = document.createElement('span');
            var span2 = document.createElement('span');
            var cook = '';

            var arr;

            $.get(`php/coueseController.php?subject=${subject}`, function(data) {
                arr = JSON.parse(data);
                console.log(arr);

                // console.log(subject);
                console.log(arr);

                var newArr = arr.filter(item => item[0] == id);

                var newCon = '';
                var len = 0;

                console.log(newArr);

                newArr.forEach(function(item) {

                    var numItem = 'a'.charCodeAt(0) + len++;
                    var charItem = String.fromCharCode(numItem).toUpperCase();

                    newCon += `           ${charItem}.${item[4]}               `;
                })


                var que = document.createTextNode(`题目：${newArr[0][1]}`);
                var sel = document.createTextNode(`选项: ${newCon}`);


                var al = 'a'.charCodeAt(0) + parseInt(newArr[0][2]);
                var newCor = String.fromCharCode(--al).toUpperCase();

                var correct = document.createTextNode(`正确答案：${newCor}`);

                li.setAttribute('class', 'add');
                span.appendChild(que);
                span1.appendChild(sel);
                span2.appendChild(correct);
                li.appendChild(span);
                li.appendChild(span1);
                li.appendChild(span2);
                $(li).insertAfter(spanId);
                spanId.addClass('active');
            })

        }
    }
    var arr = document.cookie.split(";");
    var flag = '';
    var que = document.getElementById('register-form-link');
    var head = document.getElementById('head');
    var con = document.getElementById('selection');
    var submit = document.getElementsByClassName('btn-primary')[0];
    var left = document.getElementsByClassName('left')[0];
    var next = document.getElementsByClassName('btn-info')[0];
    var redir = document.getElementById('login-form-link');
    var complete = document.getElementById('register-form');
    var stuid = '';
    var subject;

    console.log(arr);

    if (arr) {

        arr.forEach(function(item) {
            var num = item.split('=');
            console.log(num);
            if (num[0] == ' subject') {
                subject = num[1];
                console.log(222);
            }
            if (num[0] == 'stuid') {
                stuid = num[1];
            }
        })

        console.log(subject);

        $.get(`php/coueseController.php?subject=${subject}`, function(data) {
            data = JSON.parse(data);
            var obj = new Array();

            data.forEach(function(item) {
                obj.push(item[0]);
            })

            obj = _.shuffle([...new Set(obj)]);
            // console.log(obj);
            console.log(data);
            cookie.setCookie('obj', obj, 1);

            var flag = 0;
            var score = 0;
            que.onclick = function() {

                console.log(obj);

                if (obj != '' && !flag) {
                    re();
                    flag = !flag;
                }

                function re() {
                    var queNum = obj.pop();
                    // console.log(obj);
                    var corArr = data.filter(item => queNum == item[0]).sort((prev, next) => prev[3] - next[3]);

                    console.log(corArr);

                    var cookieCon = '';

                    var corQue = corArr[0][1];
                    head.innerHTML = corQue;
                    cookieCon = `${corQue},`;

                    var corCon = '';
                    var length = 0;


                    corArr.forEach(function(item) {
                        var numItem = 'a'.charCodeAt(0) + length++;
                        var charItem = String.fromCharCode(numItem).toUpperCase();
                        corCon += `<span><input type="radio" name="choose">${charItem}.${item[4]}</span>`;
                        cookieCon += `${charItem}.${item[4]}`;
                    })
                    con.innerHTML = corCon;

                    var select = '';
                    var cor = corArr[0][2];

                    cookieCon += `,${cor},`;


                    var corNum = corArr[0][0];
                    var content = left.innerHTML;
                    // console.log(submit);
                    redir.onclick = function() {
                        obj.push(queNum);
                        flag = 0;
                    }
                    console.log(left);

                    console.log(cookieCon);

                    next.onclick = function() {

                        obj.unshift(queNum);
                        console.log(obj);

                        if (obj != '') {
                            re();
                        } else {
                            alert('已答完所有题目');
                            redir.click();
                            // $(que).removeAttr('id');
                            complete.innerHTML = '';
                        }
                    }

                    submit.onclick = function() {

                        console.log(cookieCon);
                        cookie.setCookie(corArr[0][0], cookieCon, 1);

                        var all = document.getElementsByName('choose');
                        all.forEach(function(item, index) {
                            // console.log(item);
                            if (item.checked) {
                                select = ++index;
                            }
                        })

                        console.log(select);


                        if (select == cor) {
                            alert('答案正确，得两分');
                            // cookie.setCookie(corNum, 1, 1);
                            score += 2;
                            console.log(corNum);
                            content += `<li><span onclick="show(id)" id="${corArr[0][0]}">${corArr[0][0]}</span><span>2</span></li>`;
                            left.innerHTML = content;


                            var stuid;
                            var docCookie = document.cookie.split(';');
                            console.log(docCookie);
                            docCookie.forEach(function(item) {
                                var num = item.split('=');
                                console.log(num);
                                if (num[0] == ' stuid') {
                                    stuid = num[1];
                                }
                                // console.log(stuid);
                            })

                            console.log(stuid);
                            console.log(score);


                            $.post('./php/stuScore.php', {
                                'Username': stuid,
                                'score': score
                            }, function(data) {
                                console.log(data);
                            })

                            if (obj != '') {
                                re();
                            } else {
                                alert('已答完所有题目');
                                redir.click();
                                // $(que).removeAttr('id');
                                complete.innerHTML = '';
                            }

                        } else {
                            alert('答案错误，得零分');
                            // cookie.setCookie(corArr[0][0], 0, 1);
                            content += `<li><span onclick="show(id)" id="${corArr[0][0]}">${corArr[0][0]}</span><span>0</span></li>`;
                            left.innerHTML = content;
                            if (obj != '') {
                                re();
                            } else {
                                alert('已答完所有题目');
                                redir.click();
                                // $(que).removeAttr('id');
                                complete.innerHTML = '';
                            }
                        }

                    }
                }

            }

        })
    }
})()