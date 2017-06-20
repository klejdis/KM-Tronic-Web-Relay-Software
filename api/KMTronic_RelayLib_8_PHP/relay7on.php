
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[6] == 0) 
	{   $lib->toggle(7);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 7 was off and will be toggled' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 7 was on' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

