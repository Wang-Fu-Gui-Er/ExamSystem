<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 12:19
 */

require 'connDBMysql.php';
$stuId = $_POST['username'];
$stuPwd = $_POST['password'];

$stuPwd = base64_encode($stuPwd);
$project = $_POST['subject'];
print_r($stuPwd);
$queryCheckStuId = "select stuNo from student where stuNo = '$stuId'";

$result = mysql_query($queryCheckStuId);

$flag = "";
print_r($result);
while ($student=mysql_fetch_array($result)){
    $flag = $student['stuNo'];
}

print_r($flag);

if (empty($flag)){  //学号不存在
    $url = "../stureg.html";
    if (isset($url)){
        echo "<script language=\"JavaScript\" type=\"text/javascript\">window.location.href='$url';alert(\"学号不存在，请注册或重新输入\")</script>";
    }
}

//学号存在
$queryCheckPwd = "select * from student where stuNo = '$stuId'";
$PwdResult = mysql_query($queryCheckPwd);
while ($student=mysql_fetch_array($PwdResult)){
    $pwd = $student['stuPwd'];
}
if ($stuPwd == $pwd){   //登录成功，记录登录时间后跳转答题页面
    $updateTime = "update student set lastLoginTime = now() where student.stuNo = '$stuId'";
    $flag = mysql_query($updateTime);
    echo $flag;
    echo "登录成功";
    echo "<script> alert('登陆成功');
                window.location = `../stusec.html`; //跳转
             </script>";

} else{ //登录失败，密码不正确
    $url = "../stureg.html";
    if (isset($url)){
        echo "<script language=\"JavaScript\" type=\"text/javascript\">window.location.href='$url';alert(\"密码不正确，请重新输入\")</script>";
    }
}