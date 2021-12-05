<?php
session_start();
include 'connection.php';
$output = array();


$fdatarr=$_REQUEST['fdatarr'];

$a=json_decode($fdatarr);
if($a->phase_color=='' && $a->fp=='' && $a->sfp=='' && $a->mfp==''){
    echo "data array is empty";
}

$output['phase_color']= $a->phase_color;
$output['fp']= $a->fp;
$output['sfp']= $a->sfp;
$output['mfp']= $a->mfp;


echo  json_encode($output);

?>