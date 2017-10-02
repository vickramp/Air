<div class="fixed-action-btn">
  <a class="btn-floating btn-large ">
    <i class="large mdi-editor-mode-edit"></i>
  </a>
  <ul>
    <li>
      <a href="?delete=1" class="btn-floating red">
        <i class="large fa fa-trash"></i></a>
    </li>
    <li>
      <a href="?edit=1" class="btn-floating yellow ">
        <i class="large fa fa-pencil"></i></a>
    </li>
    <li>
      <a href="?add=1" class="btn-floating green">
        <i class="large fa fa-plus"></i></a>
    </li>
  </ul>
</div>
<?php
if(isset($_GET['add'])&&$_SERVER['REQUEST_METHOD']=='POST'){

  $db=connectDataBase('users');

    $q='insert into assignedcourses(staffid,batchid,courseid) values('.$_POST['staff'].','.$_POST['batch'].',\''.$_POST['course'].'\')';
  if($db->query($q)===true)
    $t=1;
  else $t=0;
    $q='select id from assignedcourses where staffid='.$_POST['staff'].' and batchid='.$_POST['batch'].' and courseid=\''.$_POST['course'].'\'';
  $tmp=$db->query($q);
  $tmp1=($tmp->fetch_assoc());
  $tmp=$tmp1['id'];
  $q='select userno from user where branch='.$_POST['batch'][0].' and sem='.$_POST['batch'][1].' and section&3='.$_POST['batch'][2];
  $res=$db->query($q);
  while($ans=$res->fetch_assoc()){
    $q='insert into subject(studentid,course_id) values('.$ans['userno'].','.$tmp.')';
    $db->query($q);
    $t++;
  }
    if($t>=2)
      echo '<script>swal("Done!", "Course Assigned Successfully", "success")</script>';
    else
      echo '<script>swal("'.$db->error.'", "Unable to assign the Course", "error")</script>';
    $db->close();
}
  if(isset($_GET['add'])){

echo'
<div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2 center ">Assign a course</h4>
                <div class="row">
                  <form action="?add=1" method="POST" class="col s12">
                  <br/>
                  <div class="row">
                    <div class="input-field col s3">
                      <select name="staff" required="">
                        <option value="" disabled selected>Staff Id</option>
                        '; $db=connectDataBase('users');
                        $res=$db->query('select * from user where type>1 order by regdno');
                        while($ans=$res->fetch_assoc()){
                          $name=$ans['regdno'].'/'.$ans['fname'].' '.$ans['mname'].' '.$ans['lname'];
                          echo '<option value="'.$ans['userno'].'">'.$name.'</option>';
                        } echo'
                        </select>
                      <label>Staff Id / Name</label>
                    </div>
                  <div class="input-field col s3">
                    <select onchange="update(this.options[this.selectedIndex].value)" name="course" required="">
                      <option value="" disabled selected>Course Id</option>
                      ';   if(check(4))
                        $res=$db->query('select * from course order by courseid');
                        else if(check(3))
                        $res=$db->query('select * from course where type=2 or branch=(select branch from user where userno='.$_SESSION['userid'].') order by courseid');
                              while($ans=$res->fetch_assoc()){
                          echo '<option value="'.$ans['courseid'].'">'.$ans['courseid'].'/'.$ans['name'].'</option>';
                        }
              echo'
                      </select>
                    <label>Course Id/Name</label>
                  </div>


                      <div class=" batch input-field col s3">
                        <select id ="batchoption" name="batch" required="">
                          <option value="" disabled selected>Batch name</option>

                         </select>
                  <label>batch Name</label>
                      </div>

                        <div class="input-field ">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                            <i class="mdi-content-send right"></i>
                          </button>
                      </div>
                      </div>


                  </form>
                  </div>
            </div>
          </div>
      </div>
<script>
function update(id){
  var request = $.ajax({
            url: "/Air/assigncourses/group/",
              method: "POST",
              data: { id : id }
            });
            request.done(function( msg ) {
                if(msg==\'disabled\')
                $(\'.batch\').hide();
              else
                $(\'.batch\').show();
              $(\'#batchoption\').html(\'<option value="" disabled selected>Batch name</option>\');
              $(\'#batchoption\').append(msg);
              $(\'select\').material_select();
                });
            request.fail(function( jqXHR, textStatus ) {
              update(id);
            });
}
</script>';
}
?>
