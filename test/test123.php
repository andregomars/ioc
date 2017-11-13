<?php

$server = "WIN-7U7AFMS7JCP\sqlexpress";
$options = array("UID"=>"sa", "PWD"=>"1234", "Database"=>"IO_Online");
 
$conn = sqlsrv_connect($server, $options);
if (!$conn) {
    die('Something went wrong while connecting to MSSQL');

}
echo 'Connected successfully';

?>