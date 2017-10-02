<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Air/css/materialize.min.css" rel="stylesheet">
    <link href="/Air/css/login.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Air/css/sweetalert.css">
    <link href="/Air/css/font-awesome.css" rel="stylesheet">
    <script src="/Air/js/jquery.min.js"></script>
    <script src="/Air/js/materialize.min.js" ></script>
    <script src="/Air/js/sweetalert.min.js"></script>
    <script>
    $(document).ready(function() {
  $('select').material_select();
});
    </script>
  </head>
  <body >
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  require $_SERVER['DOCUMENT_ROOT'] . '/Air/config/dbconfig.php' ;
$db=connectDataBase('users');
if($_POST['spno']==''){
  $_POST['spno']=0;
}
if($_POST['hpno']==''){
  $_POST['hpno']=0;
}
$b=$y=0;
if(isset($_POST['branch'])){
  $b=$_POST['branch'];
}
if(isset($_POST['branch'])&&$_POST['branch']==''){
  $b=0;
}
if(isset($_POST['year'])){
  $b=$_POST['year'];
}
if(isset($_POST['year'])&&$_POST['year']==''){
  $y=0;
}
$fp='';
  if($_FILES['image']['name']!='') {
      $img=$_FILES['image']['type'];
      $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/Air/img/users';
      $uploadfile = $uploaddir . basename($_FILES['image']['name']);
      move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
    rename($uploaddir .$_FILES['image']['name'], $uploaddir .'/pic'.$_POST['regdno'].'.jpeg');
    $fp=$uploaddir .'/pic'.$_POST['regdno'].'.jpeg';
  }
$q='insert into user (picture,regdno,fname,mname,lname,phno1,phno2,phno3,password,type,branch,sem) values(\''.mysqli_real_escape_string($db,$fp).'\',\''.mysqli_real_escape_string($db,$_POST['regdno']).'\',\''.mysqli_real_escape_string($db,$_POST['fname']).'\',\''.mysqli_real_escape_string($db,$_POST['mname']).'\',\''.mysqli_real_escape_string($db,$_POST['lname']).'\','.mysqli_real_escape_string($db,$_POST['ppno']).','.mysqli_real_escape_string($db,$_POST['hpno']).','.mysqli_real_escape_string($db,$_POST['spno']).',\''.mysqli_real_escape_string($db,crypt($_POST['ppno'],'vfdsvdf')).'\','.$_POST['priv'].','.$b.','.$y.')';
if($db->query($q)===true)
echo '<script>swal("Done!", "User Added Successfully", "success")</script>';
else {
  echo '<script>swal("failed!", "Unable to add the user", "error")</script>';
}
echo $db->error;
$db->close();
}


 ?>



  <form action="" method="POST" enctype="multipart/form-data">
	<div class="authenty signin-alt" >
    <div class="container">
          <div class="  row" >
            <div class="normal-signin ">

          <div class="col-md-12">
            <h3 style="text-align:center">Add a Student or Staff Personal</h3>

            <br/><br/>
            <div style="padding:0em 0em 0em 2em" class="row">
              <div class="col-md-6" style="padding:-2em 0em 0em 0em">
              <div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-preview thumbnail"  data-trigger="fileinput" style="width: 200px; height: 150px;">
    <img src="/Air/img/person.png" style="width:200px;height:150px" alt="..." /></div>
    <div>
      <span class="btn btn-block signin btn-file"><span class=" fileinput-new">Upload Picture</span><span class="fileinput-exists">Change</span>
      <input type="file" name="image"></span>
      <a href="#" class="btn btn-block signin fileinput-exists" data-dismiss="fileinput">Remove</a>
    </div>
  </div>
</div>
<div col="col-md-6">

<div class="row">
  <h4 style="text-align:left">Type of User: </h4>
<br/><br/>
<div class="col-md-2 col-md-offset-1 col-xs-4 col-xs-offset-1">
        <input name="priv"  value="1" type="radio" checked="" id="test1" />
        <label style="font-size:120%" for="test1">Student</label>
</div>
<div class="col-md-2 col-md-offset-1 col-xs-4 col-xs-offset-1">
      <input name="priv" type="radio" value="2" id="test2" />
      <label style="font-size:120%" for="test2">Staff</label>
    </div><br/><br/><br/>
    <div class="col-md-2 col-md-offset-1 col-xs-4 col-xs-offset-1">
      <input name="priv" type="radio" value="3" id="test3" />
      <label style="font-size:120%" for="test3">Hod</label>
    </div>
    <div class="col-md-2 col-md-offset-1 col-xs-4 col-xs-offset-1">
      <input name="priv" type="radio" id="test4" value="4" />
      <label style="font-size:120%" for="test4">Admin</label>
</div>
</div>
  <br/>
</div>

                <div class="container row">
                  <h4 style="text-align:left;margin:1.5em">Name :</h4>
                <div class="col-md-4   ">
                  <div class="un-wrap">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" name="fname" placeholder="First Name" required="required">
                  </div>  </div>
                <div class="col-md-4  ">
                  <div class="un-wrap">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" name="mname" placeholder="Middle Name" >
                  </div>  </div>
                <div class="col-md-4     ">
                  <div class="un-wrap">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" name="lname" placeholder="Last Name" required="required">
                  </div>    </div>


              </div>


              <div class="container row">
                <h4 style="text-align:left;margin:1.5em">Registration No :</h4>
              <div class="col-md-3  ">
                <div class="un-wrap">
                  <i class="fa fa-building-o"></i>
                  <input type="text" class="form-control" name="regdno" placeholder="Regd No." required="required">
                </div>  </div>

                <div class="col-md-3    ">
                  <div class="un-wrap input-group">
                    <select  class="form-control da" name="year" style="text-align:center " >
                      <option value="" selected="" disabled="">-- Select Year Of Study --</option>
                        <option value="1">I/IV</option>
                        <option value="2">II/IV</option>
                        <option value="3">III/IV</option>
                        <option value="4">IV/IV</option>

                    </select>

                  </div><br/><br/>

                      </div>


                  <div class="col-md-3   ">
                    <div class="un-wrap input-group">
                  <select name="branch" style="text-align:center" class="form-control da " >
                      <option value="" selected=""  disabled="">-- Select course Of Study --</option>
                      <option value="1">Ce</option>
                      <option value="2">Che</option>
                      <option value="3">Cs</option>
                      <option value="4">Ec</option>
                      <option value="5">Ee</option>
                      <option value="6">It</option>
                      <option value="7">Me</option>
                    </select>
                  </div> <br/><br/> </div>

                        <div class="col-md-3    ">
                          <div class="un-wrap input-group">
                            <select  class="form-control da" name="stream" style="text-align:center" >
                              <option value="" selected=""  disabled="">-- Select Stream Of Study --</option>
                                <option value="1">B Tech.</option>
                                <option value="2">M Tech.</option>

                            </select>

                          </div>
<br/><br/>
                              </div>
          </div>
          <div class="container row">
            <h4 style="text-align:left;margin:1.5em">Phone Numbers :</h4>
          <div class="col-md-4   ">
            <div class="un-wrap">
              <i class="fa fa-mobile"></i>
              <input type="text" class="form-control" name="ppno" required="" placeholder="Parent's Number" >
            </div>  </div>
          <div class="col-md-4  ">
            <div class="un-wrap">
              <i class="fa fa-phone"></i>
              <input type="text" class="form-control" name="hpno" placeholder="Home Telephone" >
            </div>  </div>
          <div class="col-md-4     ">
            <div class="un-wrap">
              <i class="fa fa-mobile"></i>
              <input type="text" class="form-control" name="spno" placeholder="Student's number">
            </div>    </div>


        </div>





            </div>
          </div>
                      <!--


												<div class="un-wrap">
													<i class="fa fa-user"></i>
											  	<input type="text" class="form-control" name="user" placeholder="Username" required="required">
												</div>
												<div class="pw-wrap">
													<i class="fa fa-lock"></i>
											  	<input type="password" class="form-control" name="pass" placeholder="Password" required="required">
												</div>


												<div class="row">
													<div class="col-md-6">
													<p>
      														<input type="radio" name="check" id="test6"  />
      														<label style="font-size:1.4rem" for="test6">Remember me</label>
													</p>
                          <p>
      														<input type="radio" name="check" id="test7"  />
      														<label style="font-size:1.4rem" for="test7">Remember me</label>
													</p>
													</div>
												</div>
												<div class="row ">
													<div class="col-md-4 col-md-offset-4">
										    		<button type="submit" class="btn btn-block signin">Sign In</button>
													</div>
												</div>
							  	</div>
								</div>

-->
</div>

</div><br/><br/>
<div class="row normal-signin ">
  <div class="col-md-4 col-md-offset-4">
    <button type="submit" class="btn btn-block signin">Add User</button>
  </div>
</div>

</div>
<br/><br/><br/><br/>
</div>

		</form>


</html>
