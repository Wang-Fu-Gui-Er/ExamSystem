<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 06:30
 */
@$con = mysqli_connect("localhost","root","root") or die("连接服务器失败，程序中断执行！");
mysqli_query($con,"set names 'utf8'");

$flag = mysqli_select_db($con,"myphp");
if (!$flag){
    echo "数据库连接失败";
}