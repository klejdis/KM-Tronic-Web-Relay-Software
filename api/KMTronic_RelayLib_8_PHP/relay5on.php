
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[4] == 0) 
	{   $lib->toggle(5);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 5 was off and will be toggled' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 5 was on' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

