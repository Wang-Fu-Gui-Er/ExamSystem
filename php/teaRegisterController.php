<meta charset="UTF-8">
<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 12:18
 */
require 'connDBMysql.php';

$teaId = $_POST['teaId'];
$teaName = $_POST['teaName'];
$teaPwd = $_POST['password'];
$teaPwd=base64_encode($teaPwd);

$queryCheck = "select * from teacher where teaNo = '$teaId'";
$result = mysql_query($queryCheck);
$flag = "";
while ($teacher = mysql_fetch_array($result)){
    $flag = $teacher['teaName'];
}
if (!empty($flag)){
    //该教师已存在
    return FALSE;
} else{ //教师不存在，执行注册操作
    $insertTea = "insert into teacher(teaNo,teaName,teaPwd) values('$teaId','$teaName','$teaPwd')";
    if (mysql_query($insertTea)){
        $url = "../teareg.html";
        if (isset($url)){
            echo "<script language=\"JavaScript\" type=\"text/javascript\">window.location.href='$url';alert(\"注册成功，请登录！\")</script>";
        }
    }
}
mysql_close($con);
?>

