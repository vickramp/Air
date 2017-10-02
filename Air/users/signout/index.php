<?php
session_start();
session_unset();
setcookie('rvrjcce','null', time() - (86400 * 7), "/");
header("location: /Air");


 ?>
