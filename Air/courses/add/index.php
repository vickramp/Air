<?php
session_start();
     require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/login_required.php';
     require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/privil.php';
     require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/dbconfig.php';
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_GET['type'])&&isset($_GET['id'])){
$db=connectDataBase('users');
$a=explode('%^',$_POST['uid']);
$b=explode('%^',$_POST['mark']);
for($i=0;$i<count($a);$i++){
  $q='select * from scores where id=(select id from subject where studentid=(select userno from user where regdno=\''.$a[$i].'\') and course_id='.$_GET['id'].')';
  $res=$db->query($q);
  $ans=$res->fetch_assoc();
  if(empty($ans)){
      $q='select id from subject where studentid=(select userno from user where regdno=\''.$a[$i].'\') and course_id='.$_GET['id'];
      $qw=$db->query($q);
      $r=$qw->fetch_assoc();
      $q='insert into scores (id,'.$_GET['type'].') values('.$r['id'].','.$b[$i].')';
}
  else
$q='update scores set '.$_GET['type'].'='.$b[$i].' where id =(select id from subject where studentid=(select userno from user where regdno=\''.$a[$i].'\') and course_id='.$_GET['id'].')';
$db->query($q);
}
$db->close();
}
else if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_GET['id'])){
  $db=connectDataBase('users');
  $b=explode('%^',$_POST['absent']);
  $date=date("Y").'-'.$_POST['month'].'-'.$_POST['day'].' '.$_POST['time'].':00';
  $q='insert into class (subjectid,description,classdatetime) values('.$_GET['id'].',\''.$_POST['description'].'\',\''.$date.'\')';
  echo $q;
$db->query($q);
echo $db->error;
$q='select id from class where subjectid='.$_GET['id'].' and description=\''.$_POST['description'].'\' and classdatetime=\''.$date.'\'';
echo $db->error;
$res=$db->query($q);
$ans=$res->fetch_assoc();
$id=$ans['id'];
echo $id;
for($i=0;$i<count($b);$i++){
  $qu='select userno from user where regdno=\''.$b[$i].'\'';
  $ress=$db->query($qu);
  echo $db->error;
  $anss=$ress->fetch_assoc();
  $q='insert into absent values('.$id.','.$anss['userno'].')';
  echo $q;
  $db->query($q);
  echo $db->error;
}
}
header("location: /Air/courses/?id=".$_GET['id']);
exit;

 ?>
