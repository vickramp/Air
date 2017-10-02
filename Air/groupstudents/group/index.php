<?php


function conv($i){
  if($i==1)
    return 'A';
    else if($i==2)
      return 'B';
      else if($i==3)
        return 'C';
}

session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Air/config/dbconfig.php' ;
    require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/login_required.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/privil.php';
     if(!check(3)){
       header("location: /Air");
       exit;
     }

if($_SERVER['REQUEST_METHOD']=='POST'){
  $db=connectDataBase('users');
  if($_POST['type']=='branch'){
    $q='update user set branch='.$_POST['value'].' where regdno  = \''.$_POST['id'].'\' ';
    $db->query($q);
    if(isset($_GET['dept'])&&($_GET['dept']!=$_POST['value']))
      echo 'del';
  }
  if($_POST['type']=='year'){
    $year=$_POST['value'];
    $year*=2;
    $year-=2;
    if(isset($_GET['sem'])&&$_GET['sem']!=0)
      $year+=$_GET['sem'];
    else
      $year++;
    if($_POST['value']==0)
      $year=0;
    $q='update user set sem='.$year.' where regdno  = '.$_POST['id'].' ';
    $db->query($q);
    if(isset($_GET['year'])&&($_GET['year']!=$_POST['value']))
        echo 'del';
  }
  if($_POST['type']=='sem'){
    if(isset($_GET['year']))
      $year=$_GET['year'];
    else
      $year=0;
    $year*=2;
    $year-=2;
    $year+=$_POST['value'];
    if($_POST['value']==0)
      $year++;
    if($_GET['year']==0)
      $year=0;
    $q='update user set sem='.$year.' where regdno  = \''.$_POST['id'].'\' ';
    $db->query($q);
    if(isset($_GET['sem'])&&($_GET['sem']!=$_POST['value']))
      echo 'del';
  }
  if($_POST['type']=='sec'){
    $q='select section from user where regdno  = \''.$_POST['id'].'\'';
    $res=$db->query($q);
    $ans=$res->fetch_assoc();
    $val=($ans['section']&12)+$_POST['value'];
    $q='update user set section='.$val.' where regdno  = \''.$_POST['id'].'\' ';
    $db->query($q);
    if(isset($_GET['div'])&&($_GET['div']!=conv($_POST['value'])))
      echo 'del';
  }
  if($_POST['type']=='div'){
    $q='select section from user where regdno  = \''.$_POST['id'].'\'';
    $res=$db->query($q);
    $ans=$res->fetch_assoc();
    $v=$ans['section']&3;
    $val=$v+($_POST['value']<<2);
    $q='update user set section='.$val.' where regdno  =\''.$_POST['id'].'\' ';
    $db->query($q);
  }
}
else{
  header("location: /Air");
}


 ?>
