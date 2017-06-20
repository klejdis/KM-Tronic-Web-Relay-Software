
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[2] == 1) 
	{   $lib->toggle(3);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 3 was on and will be toggled ' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 3 was off ' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

