
<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 03:32
 * 根据课程名称，返回给前端考试题目、选项、正确答案
 */

  require 'connDBMysqli.php';

  //$stuNo = $_GET['php'];
  $courseName = $_GET['subject'];
  //$courseName = "php";

  $queryCourseId = "select * from course where courseName = '$courseName'";
  $resultCourse = mysqli_query($con,$queryCourseId);
  while ($couese = mysqli_fetch_array($resultCourse)){
      $coueseId = $couese['courseId'];//课程号
  }
  if (isset($coueseId)){
      $queryQueId = "select s.queId,queDesc,queCorrectAns,selQueId,selInfo from selection s,question q where courseId = '$coueseId' and s.queId = q.queId";

      $question = mysqli_fetch_all(mysqli_query($con,$queryQueId));
    // print_r($question);
      $que_str = json_encode($question);
     echo $que_str;
      return $que_str;
  }
  
?>