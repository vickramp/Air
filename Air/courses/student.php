<div class="center">
  <h5> Marks: </h5>
</div>
<table class="centered striped bordered">
       <thead>
         <tr>
             <th data-field="a1">Assignment - I</th>
             <th data-field="s1">Sessional - I</th>
             <th data-field="a2">Assignment - II</th>
             <th data-field="s2">Sessional-II</th>
             <th data-field="q1">Quiz - I</th>
             <th data-field="q2">Quiz - II</th>
         </tr>
       </thead>
       <tbody>
<?php
$db=connectDataBase('users');
$q='select * from scores where id=(select id from subject where studentid='.getid().' and course_id='.$_GET['id'].')';
$res=$db->query($q);
$ans=$res->fetch_assoc();
if(!empty($ans)){
echo '<td>';
if(!empty($ans['a1']))echo $ans['a1'];
echo '</td>';
echo '<td>';
if(!empty($ans['s1']))echo $ans['s1'];
echo '</td>';
echo '<td>';
if(!empty($ans['a2']))echo $ans['a2'];
echo '</td>';
echo '<td>';
if(!empty($ans['s2']))echo $ans['s2'];
echo '</td>';
echo '<td>';
if(!empty($ans['q1']))echo $ans['q1'];
echo '</td>';
echo '<td>';
if(!empty($ans['q2']))echo $ans['q2'];
echo '</td>';
}
?>
</tbody>
</table>
</br></br>
<div class="center">
  <h5> attendence: </h5>
</div>
<?php
$q='select id,description,month(classdatetime) "month",day(classdatetime) "day",hour(classdatetime) "hour",minute(classdatetime) "minute" from class where subjectid='.$_GET['id'].' order by classdatetime';
$res=$db->query($q);
?>

<table class="centered striped bordered">
       <thead>
         <tr>
             <th data-field="a1">Class date</th>
             <th data-field="s1">Class Time</th>
             <th data-field="a2">description</th>
             <th data-field="q1">Status</th>
         </tr>
       </thead>
       <tbody>
<?php

while($ans=$res->fetch_assoc()){
  $q='select * from absent where id='.$ans['id'].' and studentid='.getid();
  $r1=$db->query($q);
  $a1=$r1->fetch_assoc();
  if(!empty($a1))
    $stat='<p class="red-text">Absent</p>';
  else
  $stat='<p class="green-text">Present</p>';
  echo'<tr><td>';
    echo $ans['day'].' / '.$ans['month'];
  echo'</td>';
  echo'<td>';
    echo $ans['hour'].' : '.$ans['minute'];
  echo'</td>';
  echo'<td>';
    echo $ans['description'];
  echo'</td>';
  echo'<td>';
    echo $stat;
  echo'</td></tr>';

}
$db->close();
 ?>
</tbody>
</table>
