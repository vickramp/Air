<?php
session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Air/config/dbconfig.php' ;
    require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/login_required.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/privil.php';
     if(!check(3)){
       header("location: /Air");
       exit;
     }
?>
<!DOCTYPE html>
<html lang="en" >
  <head>
	  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Air/css/materialize.min.css" rel="stylesheet">
    <link href="/Air/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Air/css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="/Air/css/main-style.css">
    <link rel="stylesheet" type="text/css" href="/Air/css/scroll.css">
    <script src="/Air/js/jquery.min.js"></script>
    <script src="/Air/js/sweetalert.min.js"></script>
    <style>
    li{overflow: hidden}
    </style>
  </head>
<body>

  <?php  require_once '../topnav.php';?>
 <div id="main">
        <div class="wrapper">
<?php require_once '../sidenav.php' ?>

<!--
side nav ends
content starts
-->
            <section id="content">
                <div class="container">
<?php require 'body.php'?>
                  </div>
              </section>
<!-- content ends -->


</div>
</div>
<script src="/Air/js/materialize.min.js" ></script>
  <script src="/Air/js/scroll.min.js"></script>
  <script src="/Air/js/init.js"></script>


  <script>
  <?php
  if(check(2))
  echo "
$('#editcourse').addClass('active');";
?>
  </script>
</body>
</html>
