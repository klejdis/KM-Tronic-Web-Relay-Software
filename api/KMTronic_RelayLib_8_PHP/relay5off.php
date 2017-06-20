
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[4] == 1) 
	{   $lib->toggle(5);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 5 was on and will be toggled ' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 5 was off ' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

