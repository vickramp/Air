<?php
session_start();
     require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/login_required.php';
     require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/privil.php';
     require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/dbconfig.php';
     echo '121';
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_GET['type'])&&isset($_GET['id'])){
  echo 'qwew';
$db=connectDataBase('users');
$a=explode('%^',$_POST['uid']);
$b=explode('%^',$_POST['mark']);
for($i=0;$i<count($a);$i++){
  $q='select * from scores where id=(select id from subject where studentid=(select userno from user where regdno=\''.$a[$i].'\') and course_id='.$_GET['id'].')';
  $res=$db->query($q);
  echo $q;
  echo 'acef';
  echo $db->error;
  $ans=$res->fetch_assoc();
  /*
  if(empty($ans)){
      $q='select id from subject where studentid=(select userno from user where regdno=\''.$a[$i].'\') and course_id='.$_GET['id'];
      $qw=$db->query($q);
      $r=$qw->fetch_assoc();
      $q='insert into scores (id,'.$_GET['type'].') values('.$r['id'].','.$b[$i].')';
}
  else
$q='update scores set '.$_GET['type'].'='.$b[$i].' where id =(select id from subject where studentid=(select userno from user where regdno=\''.$a[$i].'\') and course_id='.$_GET['id'].')';
$db->query($q);*/
}
$db->close();

}




 ?>
 kjvnrfjkn
