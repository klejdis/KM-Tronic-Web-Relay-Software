
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[0] == 1) 
	{   $lib->toggle(1);
		
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 1 was on and will be toggled ' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 1 was off ' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

