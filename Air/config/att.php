<?php
require_once 'dbconfig.php';
$db=connectDataBase('users');
$q='create table  if not exists class(id bigint primary key auto_increment,subjectid  bigint,description varchar(100)  ,classdatetime datetime)';
if($db->query($q)===true)
  echo 'done';
  else
  echo $db->error;
$q='create table if not exists absent (id bigint , studentid bigint)';
if($db->query($q)===true)
  echo 'done';
  else
  echo $db->error;?>
