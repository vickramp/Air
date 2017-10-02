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
  $q='insert into course(courseid,name,type,branch,year,sem) values(\''.mysqli_real_escape_string($db,strtoupper($_POST['cid'])).'\',\''.mysqli_real_escape_string($db,$_POST['name']).'\','.$_POST['type'].','.$_POST['branch'].','.$_POST['year'].','.$_POST['sem'].')';
if($db->query($q)===true)
echo '<script>swal("Done!", "Course Added Successfully", "success")</script>';
  else
  echo '<script>swal("'.$db->error.'", "Unable to add the Course", "error")</script>';
  $db->close();
}
if(isset($_GET['add'])){
  echo'
<div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2 center ">Add a course</h4>
                <div class="row">
                  <form action="?add=1" method="POST" class="col s12">
<br/>
                    <div class="row">
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="name" name="name" type="text" required="">
                        <label for="name">Name of the Course</label>
                        </div>
                        </div>
                        <div class="row">
                          <div class="input-field col m4 s12">
                            <input id="id" name="cid" type="text" required="">
                            <label for="id">Course ID</label>
                            </div>
                      <div class="input-field col m4 s12">
                          <select name="branch" required="">
                          <option value="" disabled selected>Branch</option>';
                          if(check(4))
                          echo'
                          <option value="1">Ce</option>
                          <option value="2">Che</option>
                          <option value="3">Cs</option>
                          <option value="4">Ec</option>
                          <option value="5">Ee</option>
                          <option value="6">It</option>
                          <option value="7">Mba</option>
                          <option value="8">Mca</option>
                          <option value="9">Me</option>';
                          else {
                            $db=connectDataBase('users');
                            $res=$db->query('select branch from user where userno='.$_SESSION['userid']);
                            $ans=$res->fetch_assoc();
                            switch ($ans['branch']) {
                              case '1':$branch='Ce';break;
                              case '2':$branch='Che';break;
                              case '3':$branch='Cs';break;
                              case '4':$branch='Ec';break;
                              case '5':$branch='Ee';break;
                              case '6':$branch='It';break;
                              case '7':$branch='Mba';break;
                              case '8':$branch='Mca';break;
                              case '9':$branch='Me';break;
                            }
                            $db->close();
                            echo'<option value="'.$ans['branch'].'">'.$branch.'</option>';
                          }
                      echo'  </select>
                        <label>Select Branch</label>
                      </div>
                      <div class="input-field col m4 s12">
                        <select name="year" required="">
                          <option value="" disabled selected>Year</option>
                          <option value="1">1 Btech</option>
                          <option value="2">2 Btech</option>
                          <option value="3">3 Btech</option>
                          <option value="4">4 Btech</option>
                          <option value="5">1 Mtech</option>
                          <option value="6">2 Mtech</option>
                        </select>
                        <label>Year</label>
                      </div>
                      <div class="input-field col s12 m4">
                        <select name="sem" required="">
                          <option value="" disabled selected>Semester</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                        </select>
                        <label>Semester</label>
                      </div>
                      <div class="input-field col s12 m4">
                        <select name="type" required="">
                          <option value="0" selected>Normal</option>
                          <option value="1">Closed - Elective</option>
                          <option value="2">Open - Elective</option>
                        </select>
                        <label>Type</label>
                      </div>
                      </div>
                      </div>

                          <button class="btn center cyan waves-effect waves-light right" type="submit" name="action">Submit
                            <i class="mdi-content-send right"></i>
                          </button>
</div>
                  </form>
</div>
            </div>
          </div>
      </div>';
}
?>
