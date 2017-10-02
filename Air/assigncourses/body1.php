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
                          <option value="" disabled selected>Staff Id</option>';
      $db=connectDataBase('users');
      $res=$db->query('select * from user where type>1 order by regdno');
      while($ans=$res->fetch_assoc()){
        $name=$ans['regdno'].'/'.$ans['fname'].' '.$ans['mname'].' '.$ans['lname'];
        echo '<option value="'.$ans['userno'].'">'.$name.'</option>';
      }
      echo'       </select>
                        <label>Staff Id / Name</label>
                      </div>
                      <div class="input-field col s3">
                        <select name="batch" required="">
                          <option value="" disabled selected>Batch name</option>';
                  $res=$db->query('select * from batch order by name');
                  while($ans=$res->fetch_assoc()){
                    echo '<option value="'.$ans['batchid'].'">'.$ans['name'].'</option>';
                  }
      echo' </select>
                  <label>batch Name</label>
                      </div>
                      <div class="input-field col s3">
                        <select name="course" required="">
                          <option value="" disabled selected>Course Id</option>';
                  if(check(4))
                  $res=$db->query('select * from course order by courseid');
                  else if(check(3))
                  $res=$db->query('select * from course where branch=0 or branch=(select branch from user where userno='.$_SESSION['userid'].') order by courseid');

                  while($ans=$res->fetch_assoc()){
                    echo '<option value="'.$ans['courseid'].'">'.$ans['courseid'].'/'.$ans['name'].'</option>';
                  }
      echo'      </select>
                        <label>Course Id/Name</label>
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
      ';
    }
      ?>
