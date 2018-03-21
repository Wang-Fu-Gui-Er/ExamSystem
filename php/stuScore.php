<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/25
 * Time: 下午 05:57
 * 学生答完题，提交试卷，显示分数
 */

require 'connDBMysqli.php';

$stuNo = $_POST['Username'];//学号
$score = $_POST['score'];//分数

$courseId = 1;//课程号，默认php

$queryStu = "select score from stuscore  where courseId = $courseId and stuNo = '$stuNo'";
if (!mysqli_query($con,$queryStu)){ //该学生不在成绩表中
    $addScore = "insert into stuScore(courseId,stuNo,score) values($courseId,'$stuNo',$score)";
    $f1 = mysqli_query($con,$addScore);
    if ($f1){
        print_r("sas");
        return TRUE;//成绩录入成功
    } else{
        return FALSE;//成绩录入失败
    }
} else{
    $updateScore = "update stuscore set score = $score where stuNo ='$stuNo' and courseId =$courseId";
    $f2 = mysqli_query($con,$updateScore);
    if ($f2){
        return TRUE;//成绩录入成功
    } else{
        return FALSE;//成绩录入失败
    }
}
