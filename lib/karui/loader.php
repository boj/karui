<?php
namespace Karui;

/**
 * This is a convenience class for loading models out of /app/models
 */

class Loader {

    public static function model($model) {
        $file = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $model));
        if (!file_exists(APP_ROOT."/models/".$file.".php")) {
            print "Model does not exist ".$model;
            die;
        } else {
            require_once APP_ROOT."/models/".$file.".php";
        }
        if (defined('MODEL_NAMESPACE')) {
            $model = MODEL_NAMESPACE.'\\'.$model;
        } else {
            print "Models must exist within a namespace!";
            die;
        }
            
        return new $model;    
    }
    
}

?>
