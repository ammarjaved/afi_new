<?php
session_start();
include 'connection.php';
$output = array();

$cd_id=$_GET['cd_id'];

$sql1="select count(*) from public.dp_submitted where phase='R' and meter_type='single' and cd_id ilike '$cd_id';";
$sql2="select count(*) from public.dp_submitted where phase='Y' and meter_type='single' and cd_id ilike '$cd_id';";
$sql3="select count(*) from public.dp_submitted where phase='B' and meter_type='single' and cd_id ilike '$cd_id';";
$sql4="select count(*) from public.dp_submitted where phase='RYB' and meter_type='three' and cd_id ilike '$cd_id';";

//echo $sql1."<br/>";
$query1=pg_query($sql1);
$query2=pg_query($sql2);
$query3=pg_query($sql3);
$query4=pg_query($sql4);


if($query1)
{
    $output['Rsingle'] = pg_fetch_all($query1);
}
if($query2)
{
    $output['Ysingle'] = pg_fetch_all($query2);
}
if($query3)
{
    $output['Bsingle'] = pg_fetch_all($query3);
}
if($query4)
{
    $output['RYBthree'] = pg_fetch_all($query4);
}
echo  json_encode($output);

?>