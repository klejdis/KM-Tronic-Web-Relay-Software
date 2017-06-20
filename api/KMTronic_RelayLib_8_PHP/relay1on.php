
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[0] == 0) 
	{   $lib->toggle(1);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 1 was off and will be toggled' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 1 was on' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

