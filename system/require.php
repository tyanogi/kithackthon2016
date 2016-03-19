<?php

/* Production Environment */
# define('PATH', '/home/kitsec/www/ctf/');
# define('PATH_SYS', '/home/kitsec/www/ctf/system/');

/* Local Environment */
define('PATH', 'C:/xampp/htdocs/kithackthon2016/');
define('PATH_SYS', 'C:/xampp/htdocs/kithackthon2016/system/');

/* Settings */
require_once(PATH_SYS.'config.php');

/* Class */
//require_once(PATH_SYS.'DB_Create.php'); // •K‚¸1”Ô–Ú‚É‚·‚é

require_once(PATH_SYS.'DB_Manager.php'); // •K‚¸2”Ô–Ú‚É‚·‚é
/*require_once(PATH_SYS.'DB_Evaluate.php');
require_once(PATH_SYS.'DB_Initialize.php');
require_once(PATH_SYS.'DB_Inquiry.php');
require_once(PATH_SYS.'DB_Log.php');
require_once(PATH_SYS.'DB_Question.php');
require_once(PATH_SYS.'DB_Score.php');
require_once(PATH_SYS.'DB_System.php');
require_once(PATH_SYS.'DB_Team.php');
require_once(PATH_SYS.'DB_User.php');*/
require_once(PATH_SYS.'DB_Genre.php');
require_once(PATH_SYS.'DB_Placeinfo.php');

require_once(PATH_SYS.'SYS_Manager.php'); // SYSŒn‚Ì’†‚Å‚Í1”Ôã‚É‚·‚é
/*require_once(PATH_SYS.'SYS_Basic.php');
require_once(PATH_SYS.'SYS_Front.php');
require_once(PATH_SYS.'SYS_Question.php');
require_once(PATH_SYS.'SYS_Team.php');
require_once(PATH_SYS.'SYS_User.php');
require_once(PATH_SYS.'SYS_Genre.php');*/
require_once(PATH_SYS.'SYS_Genre.php');
require_once(PATH_SYS.'SYS_Placeinfo.php');


?>
