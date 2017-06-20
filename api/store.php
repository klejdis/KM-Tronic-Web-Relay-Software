<?php
require_once 'playstation.php';

$playstation = new Playstation();

$minutes = 0;
$totaliNeLek = 0;
$leva = 0;
$openType = '';
$playstation_num = 0;
$pc_start_time  = date('Y-m-d H:i:s');

if ( isset($_POST['minutes']) && !empty($_POST['minutes']) ) {
	$minutes = $_POST['minutes'];
}


if ( isset($_POST['totaliNeLek']) && !empty($_POST['totaliNeLek']) ) {
	$totaliNeLek = $_POST['totaliNeLek'];
}


if ( isset($_POST['leva']) && !empty($_POST['leva']) ) {
	$leva = $_POST['leva'];
}

if ( isset($_POST['openType']) && !empty($_POST['openType']) ) {
	$openType = $_POST['openType'];
}

if ( isset($_POST['playstation_num']) && !empty($_POST['playstation_num']) ) {
	$playstation_num = $_POST['playstation_num'];
}


if ( isset($_POST['pc_start_time']) && !empty($_POST['pc_start_time']) ) {
	$pc_start_time = date('Y-m-d H:i:s' , strtotime($_POST['pc_start_time']));
}





$playstation->store($minutes , $totaliNeLek , $leva ,$openType, $playstation_num , $pc_start_time);








