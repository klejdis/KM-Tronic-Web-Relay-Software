<?php

include 'config.php';

$con = mysqli_connect( $config['db_host'] ,  $config['db_username'] , $config['db_password']  ,  $config['db_name'] );
if (!$con) {
    throw new Exception("Error CONNECTION TO DATABASE", 1);
}







