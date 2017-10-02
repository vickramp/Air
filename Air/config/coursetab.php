<?php

require_once 'dbconfig.php';
$db=connectDataBase('users');
$q='create table if not exists course(courseid varchar(10) unique not null,type int,year int ,branch tinyint,sem tinyint,name varchar(50) )';
if($db->query($q)===true){
	echo 'done';
}
else
	echo $db->error;
	$q='create table if not exists assignedcourses(id bigint primary key auto_increment,staffid bigint,batchid bigint,courseid varchar(10) )';
	if($db->query($q)===true){
		echo 'done';
	}
	else
		echo $db->error;

		$q='create table if not exists subject(id bigint primary key auto_increment,studentid bigint, course_id bigint )';

		if($db->query($q)===true){
			echo 'done';
		}
		else
			echo $db->error;

			$q='create table if not exists scores(id bigint ,a1 float,a2 float,s1 float,s2 float,q1 float,q2 float )';

			if($db->query($q)===true){
				echo 'done';
			}
			else
				echo $db->error;

		$q='create table if not exists batchlist(batchid bigint,studentid bigint )';
		if($db->query($q)===true){
			echo 'done';
		}
		else
			echo $db->error;
			$q='create table if not exists batch(batchid bigint,dept tinyint,name varchar(20) )';
			if($db->query($q)===true){
				echo 'done';
			}
			else
				echo $db->error;
				$db->close();
?>
