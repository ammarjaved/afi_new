<?php
session_start();
include 'connection.php';
$output = array();


$phase=$_REQUEST['phase'];
$lid=$_REQUEST['lid'];

$sql1="select count(*), fd_no from public.demand_point where phase='$phase' and (l3_id='$lid' or l2_id='$lid' or l1_id='$lid') group by fd_no;";	


//echo $sql1."<br/>";
$query1=pg_query($sql1);




if($query1)
{
    $output = pg_fetch_all($query1);
}

echo  json_encode($output);

?>