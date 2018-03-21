// module.exports = function() {
var cookie = {
        setCookie: function(key, val, date) {
            //设置cookie
            var oDate = new Date();
            oDate.getDate(oDate.getDate() + date);
            document.cookie = key + '=' + val + ';expires = ' + oDate;
            return this;
        },
        removeCookie: function(key) {
            this.setCookie(key, "", -1);
            return this;
        },
        getCookie: function(key) {
            var str = document.cookie;
            var arr = str.split(';');
            // arr.forEach(function(item) {
            //     var itemArr = item.split('=');
            //     if (itemArr[0] == key) {
            //         callback ? callback(itemArr[1]) : "";
            //     }
            // })
            return arr;
        }
    }
    // }