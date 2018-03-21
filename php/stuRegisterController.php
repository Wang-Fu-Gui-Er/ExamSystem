<meta charset="UTF-8">
<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 12:18
 */
require 'connDBMysql.php';

$stuId = $_POST['stuid'];
$stuName = $_POST['stuName'];
$stuPwd = $_POST['password'];
$queryCheck = "select * from student where stuNo = '$stuId'";

$stuPwd=base64_encode($stuPwd);// base64_encode() 加密  


// echo 'base64_decode解密后的结果为：'.base64_decode($base64encode).'<br>'; //base64_decode()解密  


$result = mysql_query($queryCheck);
$flag = "";
while ($stu = mysql_fetch_array($result)){
    $flag = $stu['stuName'];
}
if (!empty($flag)){
    //该学生已存在xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    echo '该学生已存在';
    return FALSE;
} else{ //学生不存在，执行注册操作
    $insertStu = "insert into student(stuNo,stuName,stuPwd) values('$stuId','$stuName','$stuPwd')";
    if (mysql_query($insertStu)){
        $url = "../stureg.html";
        if (isset($url)){
            echo "<script language=\"JavaScript\" type=\"text/javascript\">window.location.href='$url';alert(\"注册成功，请登录！\")</script>";
        }
    }
}
mysql_close($con);
?>

