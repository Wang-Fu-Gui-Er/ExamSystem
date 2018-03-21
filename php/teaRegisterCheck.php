<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 12:18
 */
    require 'connDBMysql.php';
    error_reporting(0);

    $regiId = $_GET['teaId'];

    $queryCheck = "select * from teacher where teaNo = '$regiId'";

    $result = mysql_query($queryCheck);

    // display_errors = Off;
    $flag = "";

    while ($stu = mysql_fetch_array($result)){
        $flag = $stu['teaName'];
    }
    if (!empty($flag)){
        $fff = "false";
        
        $fff = json_encode($fff);
        //该学生已存在xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        // echo '该学生已存在';
        print_r(0);
        return $fff;
    }else{
        print_r(true);
    }   
    mysql_close($con);
?>

