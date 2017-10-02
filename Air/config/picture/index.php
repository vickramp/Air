<?php
session_start();
header("Content-type: image/jpeg");
header('Content-Disposition: attachment; filename="dp.jpeg"');
require_once '../dbconfig.php';
	$db=connectDataBase('users');
	$q='select picture from user where userno='.$_SESSION['userid'];
	$ans=$db->query($q);
	$res=$ans->fetch_assoc();
	$pic=$res['picture'];
	if($pic==''){
		header("location: /Air/img/person.png");
		exit;
	}
	$db->close();
echo file_get_contents($pic);


?>
