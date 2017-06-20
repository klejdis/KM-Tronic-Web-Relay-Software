
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[1] == 1) 
	{   $lib->toggle(2);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 2 was on and will be toggled ' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 2 was off ' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

