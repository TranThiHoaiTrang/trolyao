<?php
unset($_SESSION[$login_member]);
setcookie('login_session',"",-1,'/');
setcookie('login_session_name',"",-1,'/');
setcookie('login_cap_user', "", -1, '/');
setcookie('login_donvi_user', "", -1, '/');
setcookie('login_user', "", -1, '/');

$func->redirect($config_base);