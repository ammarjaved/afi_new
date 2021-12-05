<?php
session_start();
include 'connection.php';
$output = array();


$fp_id=$_REQUEST['fp_id'];

$sql1="select device_id,cd_no from public.sfp_l2 where l1_id=$fp_id;";



//echo $sql1."<br/>";
$query1=pg_query($sql1);




if($query1)
{
    $output = pg_fetch_all($query1);
}

echo  json_encode($output);

?>