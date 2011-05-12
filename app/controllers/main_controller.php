<?php

class MainController extends \ApplicationController {
    
    function index() {
        print "Hello World";
    }
    
    // Parameters are passed in dynamically by name.
    function index($a, $b) {
        print "a: ".$a.", b: ".$b;
    }
    
}

?>
