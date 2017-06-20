
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[7] == 0) 
	{   $lib->toggle(8);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 8 was off and will be toggled' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 8 was on' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

