<?php
session_start();
include 'connection.php';
$output = array();


$sfp_id=$_REQUEST['sfp_id'];

$sql1="select device_id,cd_id from public.mfp_l3 where l2_id=$sfp_id;";



//echo $sql1."<br/>";
$query1=pg_query($sql1);




if($query1)
{
    $output = pg_fetch_all($query1);
}

echo  json_encode($output);

?>