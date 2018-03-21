<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 08:11
 * 模糊查询（学号、姓名、成绩），返回包含最后登录时间
 * 默认课程号courseId = 1
 */

require 'connDBMysqli.php';

$stuNo = $_GET['stuNo'];
$stuName = $_GET['stuName'];
$stuScore = $_GET['stuScore'];

//$stuNo = "15";
//$stuName = "杨雪";
//$stuScore = 70;

if (isset($stuNo)){ //学号模糊查询
    $queryStu = "select s2.stuNo,s1.stuName,s2.score,s1.lastLoginTime from student s1,stuscore s2 ".
        "where s1.stuNo = s2.stuNo and s2.courseId = 1 and s1.stuNo like '$stuNo%' order by s1.stuNo";

    $result_1 = mysqli_query($con,$queryStu);
    $stu = mysqli_fetch_all($result_1);
    $stu_str = json_encode($stu);
   print_r($stu_str);
    return $stu_str;
} else if (isset($stuName)) { //姓名模糊查询
    $queryStu = "select s2.stuNo,s1.stuName,s2.score,s1.lastLoginTime from student s1,stuscore s2 " .
        "where s1.stuNo = s2.stuNo and s2.courseId = 1 and s1.stuName like '$stuName%' order by s1.stuNo";

    $result_1 = mysqli_query($con, $queryStu);
    $stu = mysqli_fetch_all($result_1);
    $stu_str = json_encode($stu);
   print_r($stu_str);
    return $stu_str;
} else if (isset($stuScore)){ //成绩模糊查询
    $queryStu = "select s2.stuNo,s1.stuName,s2.score,s1.lastLoginTime from student s1,stuscore s2  
where s1.stuNo = s2.stuNo and s2.courseId = 1 and s2.score = '$stuScore' order by s1.stuNo;";
    $result_1 = mysqli_query($con,$queryStu);
    $stu = mysqli_fetch_all($result_1);
    $stu_str = json_encode($stu);
   print_r($stu_str);
    return $stu_str;

}
?>
