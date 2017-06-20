<?php

require_once('db.php');

$first_date = date('Y-m-d');
$end_date = date('Y-m-d');


if (isset($_POST['period']) &&  !empty($_POST['period']) ) {
	$exploded_date = explode( ' to ' , $_POST['period'] );
	$first_date = $exploded_date[0];
	$end_date = $exploded_date[1];
}



$qry = "SELECT *  from detail_logs
			WHERE date(date_created) >= '{$first_date}' and date(date_created) <= '$end_date'
			ORDER BY date_created ASC";

$exc = mysqli_query($con , $qry);

$total = 0;

$response = [];


$response['data']  = [];


while ($row = mysqli_fetch_assoc($exc) ) {
	array_push($response['data'], $row);
	$total += $row['totali_lek'];
}


$response['total']  = $total;

echo json_encode($response);

















