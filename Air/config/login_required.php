<?php
if(!isset($_SESSION['userid'])){
  $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
  header("location: /Air/users/signin?redirect=".urlencode($protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
  exit;
}

 ?>
