<?php
//generate an id for  elective & for labs get 1/2's
require_once $_SERVER['DOCUMENT_ROOT'] . '/Air/config/dbconfig.php' ;
$db=connectDataBase('users');
$res=$db->query('select * from course where courseid=\''.$_POST['id'].'\'');
$ans=$res->fetch_assoc();
if($ans['type']==0){
  $val=(($ans['year']*2)-2)+$ans['sem'];
  $q='select distinct branch,sem,section&3 "sec" from user where section!=0 and branch='.$ans['branch'].' and sem='.$val.' order by branch,sem,section';
}
else if($ans['type']>=1){
echo 'disabled';
exit;
}
echo $q;
$res=$db->query($q);
while($ans=$res->fetch_assoc()){
  switch ($ans['branch']) {
    case '1':$branch='Civil';break;
    case '2':$branch='Chem';break;
    case '3':$branch='Cse';break;
    case '4':$branch='Ece';break;
    case '5':$branch='Eee';break;
    case '6':$branch='It';break;
    case '7':$branch='Mba';break;
    case '8':$branch='Mca';break;
    case '9':$branch='Mech';break;
  }
  switch($ans['sec']){
    case 1:$sec='A';break;
    case 2:$sec='B';break;
    case 3:$sec='C';break;
  }
  $t=$ans['sem'];
  if($ans['sem']>8)
    $t='Mtech '.($ans['sem']-8);
  echo'<option value="'.$ans['branch'].$ans['sem'].$ans['sec'].'">'.$branch.' '.$t.' th sem '.' section '.$sec.'</option>';
}
$db->close();
 ?>
