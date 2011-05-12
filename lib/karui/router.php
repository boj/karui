<?php
namespace Karui;

require_once LIB_ROOT."/karui/app/controller.php";

class Router {
    
    private $default_controller;
    private $default_action;

    public function __construct($defaults=array("controller" => "main", "action" => "index")) {
        if (is_array($defaults)) {
            if (array_key_exists('controller', $defaults) && array_key_exists('action', $defaults)) {
                $this->default_controller = $defaults['controller'];
                $this->default_action     = $defaults['action'];
            } else {
                print "Router 'defaults' array must be in the form array('controller' => 'main', 'action' => 'index');";
                die;
            }    
        } else {
            print "Router 'defaults' must be in the form of an array.";
            die;
        }
    }
    
    public function route($route) {
        if (array_key_exists('route', $route)) {
            $params = explode("/", $route['route']);
        } elseif (count($route) == 0) {
            $this->run($this->default_controller, $this->default_action);
            return true;
        }
        
        $controller = array_shift($params);
        
        if (isset($params[0]))
            $action = array_shift($params);
        else
            $action = $this->default_action;
            
        $get_data = array(); 
        if (count($params) > 0) {
            while (count($params) > 0) {
                $k = array_shift($params);
                $v = array_shift($params);
                $get_data[$k] = $v;
            }
        }
        
        $this->run($controller, $action, $get_data);
    }
    
    private function run($controller, $action, $get_data=array()) {
        if (file_exists(APP_ROOT.'/application_controller.php')) {
            require_once(APP_ROOT.'/application_controller.php');
        }
        
        $file = APP_ROOT.'/controllers/'.$controller.'_controller.php';
        if (file_exists($file)) {
            require_once($file);
        } else {
            print 'Non-existent controller file path '.$file;
            die;
        }
        
        $name = ucfirst($controller).'Controller';
        if (class_exists($name)) {
            $klass = new $name;
            if (method_exists($klass, $action)) {    
                if (isset($_POST)) {
                    foreach ($_POST as $key => $value) {
                        $klass->post[$key] = $value;
                    }
                }
            
                $klass->before_filter();
                
                $reflector = new \ReflectionClass($name);
                if (count($parameters = $reflector->getMethod($action)->getParameters()) > 0) {
                    $param_list = array();
                    foreach ($parameters as $p)
                        $param_list[$p->name] = null;    
                    foreach ($get_data as $k => $v) {
                        if (array_key_exists($k, $param_list))
                            $param_list[$k] = $v;
                    }
                    call_user_func_array(array($klass, $action), $param_list);
                } else {
                    $klass->$action();
                }
                 
                $klass->after_filter();
            } else {
                print 'Non-existent controller method '.$action;
                die;
            }
        } else {
            print 'Non-existent controller class '.$controller;
            die;
        }
        return true;
    }
    
}

?>
