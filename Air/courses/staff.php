<?php if(isset($_GET['id'])){
echo '<div class="fixed-action-btn">
  <a class="btn-floating btn-large ">
    <i class="large mdi-editor-mode-edit"></i>
  </a>
  <ul>
      <li>
      <a href="?id='.$_GET['id'].'&amp;attendence=1" class="btn-floating yellow ">
        A</a>
    </li>
    <li>
      <a href="?id='.$_GET['id'].'&amp;marks=1" class="btn-floating green">
        M</a>
    </li>
  </ul>
</div>';
}
  if(isset($_GET['marks'])){
      if(!isset($_GET['type'])){
    echo'  <br /> <br /> <div class="row"> <div class="input-field col s8 offset-s2">
        <select onchange="window.location.href=\'?id='.$_GET['id'].'&amp;marks=1&amp;type=\'+this.options[this.selectedIndex].value;">
   <option value="" disabled selected>Choose your option</option>
   <option value="a1">Assignment - I</option>
   <option value="a2">Assignment - II</option>
   <option value="s1">Sessional - I</option>
   <option value="s2">Sessional - II</option>
   <option value="q1">Quiz- I</option>
   <option value="q2">Quiz - II</option>
   </select>
   <label>Exam Type</label>
   </div></div>';
      }
      else{
if(isset($_GET['type'])&&($_GET['type']!='a1'&&$_GET['type']!='a2'&&$_GET['type']!='s1'&&$_GET['type']!='s2'&&$_GET['type']!='q1'&&$_GET['type']!='q2')){
    echo'<script type="text/javascript">
    window.location.href = \'/Air/courses/\';
    </script> ';
   }
switch($_GET['type']){
  case 'a1':echo '<h5 class="center">Assignment I</h5>';break;
  case 'a2':echo '<h5 class="center">Assignment II</h5>';break;
  case 's1':echo '<h5 class="center">Sessional I</h5>';break;
  case 's2':echo '<h5 class="center">Sessional II</h5>';break;
  case 'q1':echo '<h5 class="center">Quiz I</h5>';break;
  case 'q2':echo '<h5 class="center">Quiz II</h5>';break;
}

$db=connectDataBase('users');
$q='select regdno from user where userno in(select studentid from subject where course_id='.$_GET['id'].') order by regdno ';
$res=$db->query($q);

$t=0;
echo ' <table class="striped bordered centered row">
        <thead>
          <tr>
              <th data-field="id">Regd No.</th>
              <th data-field="name">Marks</th>
          </tr>
        </thead>        <tbody>
';

while($ans=$res->fetch_assoc()){
  echo '<tr><td id="p'.$t.'">'.$ans['regdno'].'</td>';
echo'<td>
  <div class="input-field col s3 offset-m5 ">
    <input  id="'.$t.'" type="text" class="validate">
    <label class="active" for="'.$t.'">Marks</label>
  </div></td></tr>
';
$t++;
}

echo' </tbody>
      </table>
       <form  method="POST"  action="add/?id='.$_GET['id'].'&amp;type='.$_GET['type'].'" onsubmit="process()" >
       <input type="hidden" name="uid" id="uid" />
       <input type="hidden" name="mark" id="mark" />
      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
         <i class="mdi-content-send right"></i>
       </button>
       </form>

    <script>
    function process(){
      var c="",d="",n='.$t.'
      for(var i=0;i<n;i++){
        c+=document.getElementById(\'p\'+i).innerHTML;
        d+=document.getElementById(i).value;
        if(i!=n-1){
          c+=\'%^\';
          d+=\'%^\';
        }
      }
      document.getElementById("uid").value=c;
      document.getElementById("mark").value=d;
  }
  </script>
  ';
}
}
  if(isset($_GET['attendence'])){
echo '
<div class="row">
  <div class="input-field col s6 ">
    <select id="day1">
      <option value="" disabled selected>Choose your option</option>
      <option value="01"> 1</option>
      <option value="02"> 2</option>
      <option value="03"> 3</option>
      <option value="04"> 4</option>
      <option value="05"> 5</option>
      <option value="06"> 6</option>
      <option value="07"> 7</option>
      <option value="08"> 8</option>
      <option value="09"> 9</option>
      <option value="10"> 10</option>
      <option value="11"> 11</option>
      <option value="12"> 12</option>
      <option value="13"> 13</option>
      <option value="14"> 14</option>
      <option value="15"> 15</option>
      <option value="16"> 16</option>
      <option value="17"> 17</option>
      <option value="18"> 18</option>
      <option value="19"> 19</option>
      <option value="20"> 20</option>
      <option value="21"> 21</option>
      <option value="22"> 22</option>
      <option value="23"> 23</option>
      <option value="24"> 24</option>
      <option value="25"> 25</option>
      <option value="26"> 26</option>
      <option value="27"> 27</option>
      <option value="28"> 28</option>
      <option value="29"> 29</option>
      <option value="30"> 30</option>
      <option value="31"> 31</option>
      </select>
    <label>day</label>
  </div>
  <div class="input-field col s6 ">
    <select id="month1">
      <option value="" disabled selected>Choose your option</option>
      <option value="01"> 1</option>
      <option value="02"> 2</option>
      <option value="03"> 3</option>
      <option value="04"> 4</option>
      <option value="05"> 5</option>
      <option value="06"> 6</option>
      <option value="07"> 7</option>
      <option value="08"> 8</option>
      <option value="09"> 9</option>
      <option value="10"> 10</option>
      <option value="11"> 11</option>
      <option value="12"> 12</option>
    </select>
    <label>Month</label>
  </div>
  <div class="input-field col s6 ">
    <select id="time1">
      <option value="" disabled selected>Choose your option</option>
      <option value="08:10">8:10</option>
      <option value="09:00">9:00 </option>
      <option value="09:50">9:50</option>
      <option value="10:40">10:40</option>
      <option value="11:30">11:30</option>
      <option value="12:20">12:20</option>
      <option value="1:10">1:10</option>
      <option value="2:00">2:00</option>
      <option value="2:50">2:50</option>
      <option value="3:40">3:40</option>
    </select>
    <label>Time</label>
  </div>
  <div class="input-field col s12">
         <textarea  class="materialize-textarea" id="description1"></textarea>
         <label for="description1">Description</label>
         </div>

  ';

  $q='select regdno from user where userno in(select studentid from subject where course_id='.$_GET['id'].') order by regdno ';
  $res=$db->query($q);

  $t=0;
  echo ' <table class="striped bordered centered row">
          <thead>
            <tr>
                <th data-field="id">Regd No.</th>
                <th data-field="name">Status</th>
            </tr>
          </thead>        <tbody>
  ';

  while($ans=$res->fetch_assoc()){
    echo '<tr><td id="p'.$t.'">'.$ans['regdno'].'</td>';
  echo'<td>
  <div class="switch">
    <label>
      Absent
      <input checked="" id="'.$t.'" type="checkbox">
      <span class="lever"></span>
      Present
    </label>
  </div>
  </td></tr>
  ';
  $t++;
  }
echo'</tbody></table>


</button></div>
<form  method="POST"  action="/Air/courses/add/?id='.$_GET['id'].'" onsubmit="process()" >
<input type="hidden" name="absent" id="absent" />
<input type="hidden" name="day" id="day" />
<input type="hidden" name="month" id="month" />
<input type="hidden" name="description" id="description" />
<input type="hidden" name="time" id="time" />
<button class="btn waves-effect waves-light" type="submit" name="action">Submit
   <i class="mdi-content-send right"></i>
 </form>


 <script>
 function process(){
   var c="",n='.$t.';
   for(var i=0;i<n;i++){
     if(!document.getElementById(i).checked){
        c+=document.getElementById("p"+i).innerHTML;
        if(i!=n-1)
        c+=\'%^\';
     }
   }
   document.getElementById(\'month\').value=document.getElementById(\'month1\').value;
   document.getElementById(\'day\').value=document.getElementById(\'day1\').value;
   document.getElementById(\'time\').value=document.getElementById(\'time1\').value;
   document.getElementById(\'description\').value=document.getElementById(\'description1\').value;
   document.getElementById(\'absent\').value=c;
 }
</script>
 ';
  }
  ?>
