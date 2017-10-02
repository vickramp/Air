<?php
require_once 'dbconfig.php';
function check($type){
	$val=$_SESSION['type'];
	if($val>=$type)
		return true;
	else
		return false;
}
function usertype($t){
	$val=$_SESSION['type'];
	if($val==$t)
		return true;
	else
		return false;
}
function getid(){
	return $_SESSION['userid'];
}

function name(){
	$db=connectDataBase('users');
	$q='select fname,mname,lname from user where userno='.$_SESSION['userid'];
	$res=$db->query($q);
	echo $db->error;
	$rec=$res->fetch_assoc();
	$db->close();
	return $rec['fname'].' '.$rec['mname'].' '.$rec['lname'];
}
function type(){
	if($_SESSION['type']==1)
		return 'Student';
	if($_SESSION['type']==2)
		return 'Staff';
	if($_SESSION['type']==3)
		return 'Dept. Admin';
	if($_SESSION['type']==4)
		return 'Administrator';
}

?>
