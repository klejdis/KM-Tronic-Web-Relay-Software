
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[2] == 0) 
	{   $lib->toggle(3);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 3 was off and will be toggled' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 3 was on' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

