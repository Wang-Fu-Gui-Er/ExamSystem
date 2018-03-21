<?php
/**
 * Created by PhpStorm.
 * User: 8102
 * Date: 2017/12/21
 * Time: 下午 12:23
 */
@$con = mysql_connect("localhost","root","root") or die("连接服务器失败，程序中断执行！");
mysql_query("set names 'utf8'");
$flag = mysql_select_db("myphp", $con);
if (!$flag){
    echo "数据库连接失败";
}
?>