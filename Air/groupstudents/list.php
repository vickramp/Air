	<?php if(isset($_GET['div'])||(isset($_GET['year'])&&$_GET['year']==0)||(isset($_GET['dept'])&&$_GET['dept']==0)){
  echo'<br/>
                 <table class="striped centered">
                   <thead>
                     <tr>
                       <th data-field="Regdno">Regdno.</th>';
                       if(check(4))echo'<th data-field="branch">Branch</th>';
                       echo'<th data-field="year">Year</th>
                       <th data-field="sem">Sem</th>
                       <th data-field="sec">section</th>
                       <th data-field="div">Batch</th>';
                       if(isset($_GET['div'])){
                         $sem=$_GET['year']*2;
                         $sem-=2;
                         $sem+=$_GET['sem'];
                         $sem1=$sem-1;
                       $db=connectDataBase('users');
                       $q='select type from course where (type=2 and  (sem='.$sem1.' or sem='.$sem.')) or (type=1 and branch in (select branch from user where branch='.$_GET['dept'].') and (sem='.$sem1.' or sem='.$sem.'))';
                       $res=$db->query($q);
                      while($ans=$res->fetch_assoc()){
                        if($ans['type']==1)
                          echo'<th data-field="close-ele">Close-Ele</th>';
                        else
                        echo'<th data-field="open-ele">Open-Ele</th>';
                      }
                     }
                     echo'</tr></thead>
                     <tbody>';
                   }?>



<?php
if(isset($_GET['year'])&&isset($_GET['sem'])){
  $year=$_GET['year']*2;
  $year-=2;
  $year+=$_GET['sem'];
}
if(isset($_GET['div'])||(isset($_GET['year'])&&$_GET['year']==0)||(isset($_GET['dept'])&&$_GET['dept']==0)){
  $db=connectDataBase('users');
  if(isset($_GET['dept'])&&$_GET['dept']==0){
    $q='select * from  user where type=1 and branch<1 or branch>9 order by regdno';
  }
  else if(isset($_GET['year'])&&$_GET['year']==0){
      $q='select * from user where type=1 and branch='.$_GET['dept'].' and sem<1 or sem>12 order by regdno ';
  }
  else if(isset($_GET['div'])&&($_GET['div']!='A'&&$_GET['div']!='B'&&$_GET['div']!='C'))
    $q='select * from user where type=1 and branch='.$_GET['dept'].' and sem='.$year.'   and ( section is NULL or section&3 = 0) order by regdno';
else {
  switch($_GET['div']){
  case 'A':$sec=1;break;
  case 'B':$sec=2;break;
  case 'C':$sec=3;
}
  $q='select * from user where type=1 and branch='.$_GET['dept'].' and sem='.$year.' and section&3 ='.$sec.' order by regdno';
}
$ans=$db->query($q);
$db->close();
while($res=$ans->fetch_assoc()){
echo'<tr id=\''.$res['regdno'].'\'>';
echo '<td>'.$res['regdno'].'</td>';
if(check(4)){
echo'<td><select class="center" onchange="update(\''.$res['regdno'].'\',\'branch\',this.options[this.selectedIndex].value)">
      <option value="0" selected>Branch</option>
      <option value="1" '; if($res['branch']==1) echo'selected';echo'>Civil</option>
      <option value="2" '; if($res['branch']==2)echo'selected';echo'>Chem</option>
      <option value="3" '; if($res['branch']==3)echo'selected';echo'>Cse</option>
      <option value="4" '; if($res['branch']==4)echo'selected';echo'>Ece</option>
      <option value="5" '; if($res['branch']==5)echo'selected';echo'>Eee</option>
      <option value="6" '; if($res['branch']==6)echo'selected';echo'>It</option>
      <option value="7" '; if($res['branch']==7)echo'selected';echo'>Mba</option>
      <option value="8" '; if($res['branch']==8)echo'selected';echo'>Mca</option>
      <option value="9" '; if($res['branch']==9)echo'selected';echo'>Mech</option>
    </select>
    </td>';
  }
    echo'   <td>
    <select class="center" onchange="update(\''.$res['regdno'].'\',\'year\',this.options[this.selectedIndex].value)">
      <option value="0" selected>Year</option>
      <option value="1" ' ; if($res['sem']==1||$res['sem']==2) echo'selected';echo'>I/IV Btech</option>
      <option value="2" ' ; if($res['sem']==3||$res['sem']==4) echo'selected';echo'>II/IV Btech</option>
      <option value="3" ' ; if($res['sem']==5||$res['sem']==6) echo'selected';echo'>III/IV Btech</option>
      <option value="4" ' ; if($res['sem']==7||$res['sem']==8) echo'selected';echo'>IV/IV Btech</option>
      <option value="5" ' ; if($res['sem']==9||$res['sem']==10) echo'selected';echo'>I/II Mtech</option>
      <option value="6" ' ; if($res['sem']==11||$res['sem']==12) echo'selected';echo'>II/II Mtech</option>
    </select>
  </td><td>
    <select class="center" onchange="update(\''.$res['regdno'].'\',\'sem\',this.options[this.selectedIndex].value)">
      <option value="0"  selected>Semester</option>
      <option value="1" ' ; if($res['sem']%2==1) echo'selected';echo'>1st Sem</option>
      <option value="2" ' ; if($res['sem']%2==0) echo'selected';echo'> 2nd Sem</option>
    </select>
</td><td>
    <select class="center" onchange="update(\''.$res['regdno'].'\',\'sec\',this.options[this.selectedIndex].value)">
      <option value="0" selected>Section</option>
      <option value="1" '; if(($res['section']&3)==1) echo'selected';echo'>A</option>
      <option value="2" '; if(($res['section']&3)==2) echo'selected';echo'>B</option>
      <option value="3" '; if(($res['section']&3)==3) echo'selected';echo'>C</option>
    </select>
  </td>
  <td>

      <select class="center" onchange="update(\''.$res['regdno'].'\',\'div\',this.options[this.selectedIndex].value)">
        <option value="0" '; if((($res['section']&12)>>2)==0) echo'selected';echo'>None</option>
        <option value="1" '; if((($res['section']&12)>>2)==1) echo'selected';echo'>1</option>
        <option value="2" '; if((($res['section']&12)>>2)==2) echo'selected';echo'>2</option>
      </select>
    </td>
';
$q='select ';



echo '</tr>';
}
if(isset($_GET['div'])||(isset($_GET['year'])&&$_GET['year']==0)||(isset($_GET['dept'])&&$_GET['dept']==0)){
  echo' </tbody>
 </table>';
}
}
 ?>
<script>
function update(id,type,value){
  var request=$.ajax({url:'/Air/groupstudents/group/?<?php if(isset($_GET['dept']))echo'dept='.$_GET['dept'].'&';if(isset($_GET['year']))echo'year='.$_GET['year'].'&';if(isset($_GET['sem']))echo'sem='.$_GET['sem'].'&';if(isset($_GET['div']))echo'div='.$_GET['div'];?>',method:"POST",data:{id:id,type:type,value:value}});
  request.done(function( msg ){if(msg=='del'){$("#"+id).remove();}});
  request.fail(function( jqXHR, textStatus ){ update(id,type,value);});
}
</script>
