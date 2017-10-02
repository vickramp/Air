<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbport = 3306;
function connectDataBase($value='')
{
	return new mysqli('localhost', 'root','', $value, 3306);
}
?>
