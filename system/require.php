<?php

/* Production Environment */
# define('PATH', '/home/kitsec/www/ctf/');
# define('PATH_SYS', '/home/kitsec/www/ctf/system/');

/* Local Environment */
define('PATH', 'C:/xampp/htdocs/kit-hackathon/');
define('PATH_SYS', 'C:/xampp/htdocs/kit-hackathon/system/');

/* Settings */
require_once(PATH_SYS.'config.php');

/* Class */
//require_once(PATH_SYS.'DB_Create.php'); // 必ず1番目にする

require_once(PATH_SYS.'DB_Manager.php'); // 必ず2番目にする
/*require_once(PATH_SYS.'DB_Evaluate.php');
require_once(PATH_SYS.'DB_Genre.php');
require_once(PATH_SYS.'DB_Initialize.php');
require_once(PATH_SYS.'DB_Inquiry.php');
require_once(PATH_SYS.'DB_Log.php');
require_once(PATH_SYS.'DB_Question.php');
require_once(PATH_SYS.'DB_Score.php');
require_once(PATH_SYS.'DB_System.php');
require_once(PATH_SYS.'DB_Team.php');
require_once(PATH_SYS.'DB_User.php');*/

require_once(PATH_SYS.'SYS_Manager.php'); // SYS系の中では1番上にする
/*require_once(PATH_SYS.'SYS_Basic.php');
require_once(PATH_SYS.'SYS_Front.php');
require_once(PATH_SYS.'SYS_Question.php');
require_once(PATH_SYS.'SYS_Team.php');
require_once(PATH_SYS.'SYS_User.php');
require_once(PATH_SYS.'SYS_Genre.php');*/


?>
