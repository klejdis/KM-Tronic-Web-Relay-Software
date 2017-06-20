<?php

class Playstation
{
	private $con;

	public function store($minutes , $totaliNeLek , $leva , $openType , $playstation_num , $pc_start_time){

		$now = date('Y-m-d H:i:s');
		$end_time = date('Y-m-d H:i:s' , strtotime('+'.$minutes.'minutes' ,  strtotime($now) ) );

		$qry = "INSERT INTO `detail_logs`( `date_created`, `date_modified`, `pc_start_time`, `pc_end_time`, `totali_lek`, `open_type`, `leva`, `playstation_number`)
		 VALUES ( NOW() , NOW() , '".$pc_start_time."' , '".$end_time."', ".$totaliNeLek." , '".$openType."' , ".$leva." , ".$playstation_num." )";
		
		$exc_qry = mysqli_query($this->con , $qry);

		if ($exc_qry) {
			echo json_encode(['status' => 'OK']);	
		}else{
			echo json_encode(['status' => 'ERROR']);
		}	

	}
	
	function __construct()
	{
		$this->connectToDB();
	}
	private function connectToDB(){
		require_once('config.php');
		$con = mysqli_connect( $config['db_host'] ,  $config['db_username'] , $config['db_password']  ,  $config['db_name'] );
		if (!$con) {
			throw new Exception("Error CONNECTION TO DATABASE", 1);
		}
		$this->con = $con;
	}
}





















