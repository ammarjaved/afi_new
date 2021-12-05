<?php
session_start();
include 'connection.php';
$output = array();



$sql1="select id,status,pe_name,l1_id,cd_id from public.fpl1 where status='Completed';";




//echo $sql1."<br/>";
$query1=pg_query($sql1);





if($query1)
{
    $output= pg_fetch_all($query1);
}


echo  json_encode($output);

?><?php
