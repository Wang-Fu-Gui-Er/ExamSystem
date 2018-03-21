
<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 06:35
 * 教师登录（教师id），查看所选择的课程（课程名称）的学生信息（学号、姓名、最后登录时间、成绩）
 */
require 'connDBMysqli.php';

$teaId = $_GET['teaId'];
$courseName = $_GET['subject'];
// $teaId = 0000002;
// $courseName = "php";

//权限验证
$queryCourseId = "select * from course where courseName = '$courseName'";
$resultCourse = mysqli_query($con, $queryCourseId);
$Course = mysqli_fetch_array($resultCourse);
$courseId = $Course['courseId'];//课程号
//echo $courseId;


if (isset($courseId)) {
    $flag1 = "";
    $check = "select * from course_tea where courseId = '$courseId'";
    $result = mysqli_query($con, $check);
    while ($course_tea = mysqli_fetch_array($result)) {
        if ($course_tea['teaNo'] == $teaId) { //有权限
            $flag1 = "true";
            break;
        }
    }
    // echo $flag1;
    if ($flag1 == "true") {    //有权限
        $query = "select s.stuNo,s.stuName,s.lastLoginTime,c.score from student s,stuscore c where s.stuNo = c.stuNo and c.courseId = 1 order by s.stuNo";
        $result = mysqli_fetch_all(mysqli_query($con, $query));
        $result_str = json_encode($result);
        print_r($result_str);        
        //echo $result_str;
        return $result_str;
    } else { //没有权限,跳转回教师登录界面
        echo "没有权限";
    }
}
?>