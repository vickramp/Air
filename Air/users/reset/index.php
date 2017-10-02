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
  </head>
  <body >
<?php
session_start();
if(isset($_SESSION['userid'])){
  header("location: /Air");
  exit;
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/Air/config/dbconfig.php' ;
if(isset($_GET['user']) && isset($_GET['token'])&&(!isset($_SESSION['verified']))){
  $email=urldecode($_GET['user']);
  $tmp=explode('|\_/|',urldecode($_GET['token']));
  $password=$tmp[1];
  if($tmp[0]<microtime($get_as_float = true ) || $tmp[0]>(microtime($get_as_float = true )+7200)){
          echo '<script>sweetAlert("Oops...", "Token Expired!", "error");</script>';

  }
  else{
          $db=connectDataBase('users');
          $q='select * from user where email=\''.mysqli_real_escape_string($db,$email).'\' and password=\''.mysqli_real_escape_string($db,$password).'\'';
          $result=$db->query($q);
          $db->close();
          if (!$result->num_rows > 0)
          echo '<script>sweetAlert("Oops...", "Invalid Token!", "error");</script>';
         else{
          $ans=$result->fetch_assoc();
          $_SESSION['verified']=urldecode($_GET['user']);
          header("location: /Air/users/reset ");
        }
}
}
else if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  $y='update user set password=\''.crypt($_POST['password']).'\' where email=\''.$_SESSION['verified'].'\'';
  $db=connectDataBase('users');
  $db->query($y);
  $db->close();
  session_unset();
  echo '<script>swal("Done!", "Password Changed", "success")</script>';

}
else if(isset($_SESSION['verified'])){
  echo'
<form action="" method="post">
      <div class="authenty signin-alt" >

              <div class="container row" >
                <div class="col-md-4 col-md-offset-4">
                  <div class="normal-signin">
                    <div style="text-align:center" class=" center ">
                      <h3>Reset Your Password</h3>
                      </div>
                      <br/><br />
                        <div class="un-wrap">
                          <i class="fa fa-key"></i>
                          <input type="password" class="form-control" name="password" placeholder="Enter New Password" required="required">
                          </div>
                          <div class="un-wrap">
                          <i class="fa fa-key"></i>
                          <input type="password" class="form-control" name="p" placeholder="Re-Enter Ur Password" required="required">
                          </div>

                        <br/>
                        <div class="row ">
                          <div class="col-md-6 col-md-offset-3">
                            <button width="100" type="submit" class="btn btn-block signin">Update Password</button>
                    </div>
                  </div>
                </div>

            </div>
          </div>

        <br/><br/><br/>
      </div>
</form>
 ';
}
else{
  header("location: /Air");
  exit;
}
?>








</body>
</html>
