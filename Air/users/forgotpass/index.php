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
  header("location: /Air/");
  exit;
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/Air/config/dbconfig.php' ;
       if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST['email'])){

    $email = $_POST['email'];
    $db=connectDataBase('users');
    $query="select email,password,fname,lname from user where email='".mysqli_real_escape_string($db,$email)."'";
    $result   = $db->query($query);
    $db->close();
if(! $result->num_rows >0)
      echo '<script>swal({
  title: "Error!",
  text: "Email not linked to any account !   ",
  type: "error",
  confirmButtonText: "Ok"
});</script>';

    else{
       $row=$result->fetch_assoc();
    	$email=$row['email'];
      $name=$row['fname'].' '.$row['lname'];
        $password=(microtime($get_as_float = true )+7200).'|\_/|'.$row['password'];
      $to = $email;
      $subject = " Reset your Rvrjcce account password";
      $txt = 'Dear , '.$name.'<br /><br />

      There was recently a request to change the password for your account.<br /><br />

      If you requested this password change, please click on the following <a href="http://rvrjcce.ac.in/Air/users/reset/?user='.urldecode($email).'&token='.urlencode($password).'" target="_blank">link</a> to reset your password,</br ><br />
      this link is only valid for 2 hours so hurry up. Do not share this link with any others,<br /> by doing so u can loose control over your account.<br /><br />
      If you did not make this request, you can ignore this message and your password will remain the same.<br /><br />

      Sincerely,<br />
      Phoenix team';

      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


      $headers .= 'From: RvrJcce <no_reply@rvrjcce.ac.in>' . "\r\n";


      mail($to,$subject,$txt,$headers);
     echo '<script> swal("your email is :'.$email.'", "conformation link is sent to ur mail", "success")
      </script>';
      echo 'sent';
    }

   }
 }
?>




<form action="" method="post">
			<div class="authenty signin-alt" >

							<div class="container row" >
							  <div class="col-md-4 col-md-offset-4">
									<div class="normal-signin">
										<div style="text-align:center" >
                      <h3>Forgot your password?</h3>
  										<p>Not to worry. Just enter your email address below and we'll send you an instruction email for recovery.</p>
                        <br/>
										</div>
									  <div class="form-main">
										  <div class="form-group">
												<div class="un-wrap">
													<i class="fa fa-envelope"></i>
											  	<input type="text" class="form-control" name="email" placeholder="Email" required="required">
                          <br/>
												<div class="row ">
													<div class="col-md-6 col-md-offset-3">
										    		<button width="100" type="submit" class="btn btn-block signin">Reset Password</button>
													</div>
												</div>
									  	</div>
										</div>
							  	</div>
								</div>




				</div><br/><br/><br/>
			</div></div>
</form>

</html>
