<?php

if(isset($_GET['id'])){
$db=connectDataBase('users');
if(usertype(1)){
    $q='select * from subject where studentid='.getid().' and  course_id='.$_GET['id'];
    $res=$db->query($q);
    $ans=$res->fetch_assoc();
    if(empty($ans)){
      header("location: /Air/courses");
      exit;
    }
}
else if (usertype(2)){
    $q='select * from assignedcourses where staffid='.getid().' and id='.$_GET['id'];
  $res=$db->query($q);
  $ans=$res->fetch_assoc();
  if(empty($ans)){
    header("location: /Air/courses");
    exit;
  }
}

else if (usertype(3)){
    $q='select * from assignedcourses where id='.$_GET['id'].' and staffid in(select userno from user where branch=(select bracch from users where userno='.getid().'))';
  $res=$db->query($q);
  $ans=$res->fetch_assoc();
  if(empty($ans)){
    header("location: /Air/courses");
    exit;
  }
}
else if (usertype(4)){
    $q='select * from assignedcourses where id='.$_GET['id'].' and staffid in(select userno from user )';
  $res=$db->query($q);
  $ans=$res->fetch_assoc();
  if(empty($ans)){
    header("location: /Air/courses");
    exit;
  }
}
}
 ?>
