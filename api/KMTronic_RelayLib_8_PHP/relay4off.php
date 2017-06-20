
<?php

include 'RelayLib.php';
try 
{
	$status = $lib->status();

	if ($status[3] == 1) 
	{   $lib->toggle(4);
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 4 was on and will be toggled ' ]);
		
	} 
	else 
	{
		echo json_encode(['status' => 'OK' , 'mesagge' => 'Playstation 4 was off ' ]);
	}
	
} 
catch (Exception $exc) 
{
	
	echo $exc->getMessage().'<br/>';
	echo $exc->getTraceAsString();
	die();
}

