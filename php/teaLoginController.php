<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 12:19
 */

require 'connDBMysql.php';
$teaId = $_POST['username'];
$teaPwd = $_POST['password'];

$teaPwd = base64_encode($teaPwd);

$queryCheckTeaId = "select teaName from teacher where teaNo = '$teaId'";
$result = mysql_query($queryCheckTeaId);
$flag = "";
while ($teacher=mysql_fetch_array($result)){
    $flag = $teacher['teaName'];
}

if (empty($flag)){  //职工号不存在
    $url = "../teareg.html";
    if (isset($url)){
        echo "<script language=\"JavaScript\" type=\"text/javascript\">window.location.href='$url';alert(\"职工号不存在，请注册或重新输入\")</script>";
    }
}
$queryCheckPwd = "select * from teacher where teaNo = '$teaId'";
$PwdResult = mysql_query($queryCheckPwd);
while ($teacher=mysql_fetch_array($PwdResult)){
    $pwd = $teacher['teaPwd'];
}
if ($teaPwd == $pwd){   //登录成功，跳转答题页面
    echo "登录成功";
    echo "<script> alert('登陆成功');
            window.location = `../teasec.html`; //跳转
        </script>";

} else{ //登录失败，密码不正确
    $url = "../teareg.html";
    if (isset($url)){
        echo "<script language=\"JavaScript\" type=\"text/javascript\">window.location.href='$url';alert(\"密码不正确，请重新输入\")</script>";
    }
}