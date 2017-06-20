
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[5] == 1) 
	{   $lib->toggle(6);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 6 was on and will be toggled ' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 6 was off ' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

