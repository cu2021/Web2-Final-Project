<?php
// session_start();
// session_unset();
// session_destroy();
setcookie('is_logon', true, time() - 3600);
header('Location:login.php');