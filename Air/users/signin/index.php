<?php
session_start();
if(isset($_GET['type'])&&($_GET['type']=='fb'||$_GET['type']=='google')){
  	 require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/dbconfig.php';
  	 $db=connectDataBase('users');
     $q='select * from user where '.$_GET['type'].'='.$_POST['id'];
     $sol=$db->query($q);
     $res=$sol->fetch_assoc();
     echo $db->error;
     if(!empty($res))
     {
       $_SESSION['userid']=$res['userno'];
       $_SESSION['type']=$res['type'];
       echo 'true';
     }
exit;
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="273047413688-is8hfrrv9ods54oi1i4shaaikfdle05h.apps.googleusercontent.com">
    <link href="/Air/css/materialize.min.css" rel="stylesheet">
    <link href="/Air/css/login.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Air/css/sweetalert.css">
    <link href="/Air/css/font-awesome.css" rel="stylesheet">
    <script src="/Air/js/jquery.min.js"></script>
    <script src="/Air/js/materialize.min.js" ></script>
    <script src="/Air/js/sweetalert.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body >


<?php
if(isset($_SESSION['userid'])){
  header("location: /Air");
  exit;
}
$cookie_name='rvrjcce';
if(isset($_COOKIE[$cookie_name]))
{
  require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/dbconfig.php';
  $db=connectDataBase('users');
  $q='select * from user where password=\''.$_COOKIE[$cookie_name].'\'';
  $result=$db->query($q);
  $a=$result->fetch_assoc();
  if(!empty($a))
  {
    setcookie('rvrjcce',$a['password'], time() + (86400 * 7), "/");

    $_SESSION['userid']=$a['userno'];
    $_SESSION['type']=$a['type'];
    if(isset($_GET['redirect']))
    header("location: ".urldecode($_GET['redirect']));
    else
    header("location: /Air");
    exit;
  }
  $db->close();

}
if($_SERVER['REQUEST_METHOD']=='POST'){

	 require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/dbconfig.php';
	 $db=connectDataBase('users');
	 $q='select * from user where email=\''.mysqli_real_escape_string($db,$_POST['user']).'\' or regdno=\''.mysqli_real_escape_string($db,$_POST['user']).'\'';
	 $res=$db->query($q);
	 $db->close();
	 if (! $res->num_rows > 0)
    	echo'<script>swal("Oops...","Invalid Username and Password Try again !!","error");</script>';
		else{
		$row=$res->fetch_assoc();
		$val=$row['password'];
		if (password_verify($_POST['pass'],$val)){
   			$_SESSION['userid']=$row['userno'];
    		$_SESSION['type']=$row['type'];

    		if($_POST['check']=='on'){
      			setcookie('rvrjcce',$val, time() + (86400 * 7), "/");
    		}
    		if(isset($_GET['redirect']))
      			header("location: ".urldecode($_GET['redirect']));
    		else
      			header("location: /Air");
  			exit;
  		}
  		else{
        echo'<script>swal("Oops...","Invalid Password Try again !!","error");</script>';
    	}
 }
}

 ?>

    <script>
    function statusChangeCallback(response) {
      console.log('statusChangeCallback');
      console.log(response);
      if (response.status === 'connected')
        testAPI(response);
      }
    function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
    }
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '244976029169771',
        cookie     : true,
        xfbml      : true,
        version    : 'v2.5'
      });
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
      };
    function valid(stat,type){
        var request = $.ajax({
            url: "?type="+type,
              method: "POST",
              data: { id : stat }
            });
            request.done(function( msg ) {
              if(msg=='true')
                window.location.assign("/Air");
              else if(t)
                swal("Oops...","Not Authorized to login using "+type+msg+" !!","error");
              });
            request.fail(function( jqXHR, textStatus ) {
              valid(stat);
            });
      }
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }( document, 'script', 'facebook-jssdk'));
    function testAPI(res) {
      console.log('Welcome!  Fetching your information.... ');
      FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      valid(res.authResponse.userID,'fb');
      });
    }
    function Google_signIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      valid(profile.getId(),'google');
      }
        </script>


  <form action="" method="POST">


			<div class="authenty signin-alt" >

							<div class=" container row" >
							  <div class="col-md-4 col-md-offset-1">
									<div class="normal-signin">
											<h3 style="text-align:center">Sign In</h3>
											<br /><br />


												<div class="un-wrap">
													<i class="fa fa-user"></i>
											  	<input type="text" class="form-control" name="user" placeholder="Email or Redg no." required="required">
												</div>
												<div class="pw-wrap">
													<i class="fa fa-lock"></i>
											  	<input type="password" class="form-control" name="pass" placeholder="Password" required="required">
												</div>


												<div class="row">
													<div class="col-md-6">
													<p>
      														<input type="checkbox" name="check" id="test6"  />
      														<label style="font-size:1.4rem" for="test6">Remember me</label>
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
								<div class="col-md-2">
									<div class="horizontal-divider"></div>
								</div>

								<div class="col-md-4">
									<div class="sns-signin">

										<a href="#"   onclick="fb_login()" class="facebook"><i class="fa fa-facebook"></i><span>Sign in with Facebook</span></a>
										<a href="#" class="google-plus g-signin2"><i class="fa fa-google-plus"></i><span>Sign in with Google+</span></a>
									</div>
								</div>
							</div>
              <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
              </fb:login-button>
<div  data-onsuccess="Google_signIn" data-theme="light" data-width="200"></div>
					<div class="col-xs-6 col-md-2 col-md-offset-1">
									<a href="../forgotpass" id="forgot_from_2">need help?</a>
								</div>
				<br/><br/><br/>
</div>

		</form>

</html>
