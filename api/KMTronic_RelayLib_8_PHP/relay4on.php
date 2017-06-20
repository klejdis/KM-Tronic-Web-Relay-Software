
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[3] == 0) 
	{   $lib->toggle(4);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 4 was off and will be toggled' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 4 was on' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

