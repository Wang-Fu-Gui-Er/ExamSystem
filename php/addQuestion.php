<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/23
 * Time: 下午 11:16
 * 老师进行题目录入，默认是courseId = 1;
 */

require 'connDBMysqli.php';
$queDesc = $_POST['ques'];//题干
$ans = $_POST['cor'];//正确选项[大写字母]
$correctAns = $ans-'A'+1;//正确选项转数字
$selCount = $_POST['count'];//选项个数
$courseId = 1;//默认科目php
$selInfo = array($_POST['1']);//前端传来的第一个选项id

for ($j = 2; $j <= $selCount; $j++){    //把每题每一个选项的内容放到$selInfo数组中
    $selInfo[] = $_POST[$j];
}
//print_r($selInfo);


$addQue = "insert into question(queDesc,queCorrectAns,courseId) values('$queDesc',$correctAns,'$courseId')";

if (mysqli_query($con,$addQue)){    //题干添加成功
    for ($i = 1; $i <= $selCount; $i++){    //添加所有选项
        $info = $selInfo[$i-1];
        $addSelec = "insert into selection(selQueId,selInfo,queId) values($i,'$info',last_insert_id())";
        if (mysqli_query($con,$addSelec)){  //题目添加成功
            //echo "题目添加成功";
            echo "<script> alert('添加成功');
                window.location = \"../teasec.html\"; //跳转
            </script>";
        } else {    //题目添加失败
            //echo "题目添加失败";
            echo "<script> alert('题目添加失败');
                window.location = \"../teasec.html\"; //跳转
            </script>";
        }
    }
} else{ //题干添加失败
    //echo "题干添加失败";
     echo "<script> alert('题干添加失败');
         window.location = \"../teasec.html\"; //跳转
     </script>";
}
?>
