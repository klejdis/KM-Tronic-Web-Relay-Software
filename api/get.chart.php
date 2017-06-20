<?php
require_once('db.php');

$first_date = date('Y-m-01');
$end_date = date('Y-m-t');


if (isset($_POST['period']) &&  !empty($_POST['period']) ) {
	$exploded_date = explode( ' to ' , $_POST['period'] );
	$first_date = $exploded_date[0];
	$end_date = $exploded_date[1];
}



$qry = "SELECT COUNT(*) as total , date(date_created) as day from detail_logs
			WHERE date(date_created) >= '{$first_date}' and date(date_created) <= '$end_date'
			GROUP BY date(date_created)
			ORDER BY date(date_created) ASC";

$exc = mysqli_query($con , $qry);


$obj = [];
$obj['type'] = 'column';
$obj['showInLegend'] = 'true';
$obj['legendMarkerColor'] = 'grey';
$obj['legendText'] = 'klientet';
$obj['dataPoints'] = [];


while ($row = mysqli_fetch_assoc($exc)) {

 $item = [];
 $item['y'] = intval($row['total']);
 $item['label'] = $row['day'];

 array_push($obj['dataPoints'], $item);
}




echo json_encode(['data' => $obj]);



