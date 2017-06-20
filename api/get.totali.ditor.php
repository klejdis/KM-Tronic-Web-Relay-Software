<?php

require_once('db.php');

$date = date('Y-m-d');


$qry = "SELECT SUM(totali_lek) as totali  from detail_logs
			WHERE date(date_created) = '{$date}' ";

$exc = mysqli_query($con , $qry);

$rezult = mysqli_fetch_assoc($exc);

echo json_encode(['totali' => $rezult['totali'] ]);
 










