<?php

//*************************************
// System Defines
//*************************************
define('APP_ENV', getenv('APPLICATION_ENV'));
define('SYS_ROOT', dirname(__FILE__)."/..");
define('LIB_ROOT', SYS_ROOT."/lib");
define('APP_ROOT', SYS_ROOT."/app");
define('CNF_ROOT', SYS_ROOT."/config");
define('PUB_ROOT', SYS_ROOT."/public");

//*************************************
// System Environment
//*************************************
require_once(CNF_ROOT.'/environment.php');
require_once(CNF_ROOT.'/database.php');

//*************************************
// Loaders
//*************************************
$handle = opendir(CNF_ROOT."/loaders");
while (false !== ($file = readdir($handle))) {
    if ($file != "." && $file != "..")
        require_once CNF_ROOT."/loaders/".$file;
}
closedir($handle);

//*************************************
// Misc
//*************************************
if (file_exists(APP_ROOT."/application_model.php"))
    require_once APP_ROOT."/application_model.php";
require_once(LIB_ROOT."/karui/loader.php");

//*************************************
// Routes
//*************************************
require_once(LIB_ROOT."/karui/router.php");

// If you need/want to change the default route from main/index, set it here.

/*$router = new Karui\Router(
    array(
        'controller' => 'test',
        'action'     => 'index'
    )
);*/
$router = new Karui\Router();
$router->route($_GET);
?>
