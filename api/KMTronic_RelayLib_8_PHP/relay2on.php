
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[1] == 0) 
	{   $lib->toggle(2);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 2 was off and will be toggled' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 2 was on' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

