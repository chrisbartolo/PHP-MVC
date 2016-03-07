<?php
/**
 * this is the bootstrap class - its purpose is to serve as a router for all calls and requests while handling errors, controller calls and function calls
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

class Bootstrap {
    private $_Registry = null;
    
    private $_actualURL = "";
    private $_queryURL = "";
    
    public function __construct($Registry) {
        $this->_Registry = $Registry;
        
        /**
         * initialise the classes to make call to autoloader
         */
        $VarsConfig         = new VarsConfig();
        $DefaultsConfig  = new DefaultsConfig();
    }
    
    /**
     * Set whether the request is being done through the API
     * @param boolean $status
     */
    public function setIsApi($status = false) {
        $this->_Registry->isAPI = $status;
        //$this->_Registry->output_format = VarsConfig::$output_formats[0]
    }
    
    /**
     * parse the URL and fetch the needed parameter part
     * @param array $params the url exploded by a slashe
     * @param string $part the needed part
     * @return string|array
     */
    private function _extractFromUrl($params, $part) {
        if(empty($this->_queryURL )) {
            $this->_actualURL   = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $this->_queryURL    = trim("$_SERVER[REQUEST_URI]", '/');
        }
        
        switch($part) {
            case "functionality"    : 
                $link_parts = explode("#", $this->_queryURL);
                return explode("/",$link_parts[0]);
            case "arguments"       : 
                $link_parts = explode("#", $this->_queryURL);
                if(!empty($link_parts[1])) {
                    $args = explode("/",$link_parts[1]);
                } else {
                    $args = array();
                }
                return $args;
            case "controller"         : 
                if(isset($params[0]) && !empty($params[0])) {
                    return $params[0];
                } else {
                    return "Index";
                }
                break;
            case "function"            : 
                if(isset($params[1]) && !empty($params[1])) {
                    return $params[1];
                } else {
                    return "Index";
                }
                break;
        }
    }
    
    /**
     * This function will be used to handle what controller is to be called, what function and to define what the parameters being sent through the call are. 
     * The full path of the controller shall include the language required , controller name, and function index
     * which is then seperated with a # to show the arguments calls
     * Arguments order is important! For an empty argument, leave blank between the slashes: user/view#all/1
     */
    public function parseURL() {        
        $params = $this->_extractFromUrl(null, "functionality");
        
        //filter out any attempts to enter badly formed controllers or function calls
        foreach($params as $index => $item) {
            if(!empty($item) && !ctype_alnum($item)) {
                $this->_callControllerError();
                return;
            }
        }
        
        /*
        //Check if a format type has been explixicitly requested; if not, use default
        if(!empty($params)) {
            $outputFormat = array_search($params, VarsConfig::$output_formats);
            if($outputFormat === false) {
                $this->_Registry->output_format = DefaultsConfig::$output_format;
            } else {
                $this->_Registry->output_format = $outputFormat;
                $params = array_shift($params);
            }
        } else {
            $this->_Registry->output_format = DefaultsConfig::$output_format;
        } */
        
        //Check if a language has been explixicitly requested; if not, use default
        if(!empty($params)) {
            $language = array_search($params, VarsConfig::$translatable_languages);
            if($language === false) {
                $this->_Registry->language = DefaultsConfig::$language;
            } else {
                $this->_Registry->language = $language;
                $params = array_shift($params);
            }
        } else {
            $this->_Registry->language = DefaultsConfig::$language;
        } 
        
        //define what part of the URL query is what but first check for malformed request
        if(count($params) > 3) {
            $this->_callControllerError();
            return;
        }
        
        $controller_name    =   $this->_extractFromUrl($params, "controller");
        $function_name       =   $this->_extractFromUrl($params, "function");
        $args                           =   $this->_extractFromUrl($params, "arguments");
        $this->_callControllerFunction($this->_callController($controller_name), $function_name, $args);
    }
    
    /**
     * Check if the requested controller exists, and initiate it
     * @param string $controller
     * @return  initiated class \$controller
     */
    private function _callController($controller = "Index") {
        if(file_exists(__CONTOLLER_PATH__.$controller."Controller.php")) {
            $controller_name = $controller."Controller";
            return new $controller_name($this->_Registry);
        }
    }
    
    /**
     * Check if the function belongs to the initiated controller, if it is, make the method call
     * @param object $controller the initiated controller 
     * @param string $function the name of the function/methd
     * @param array $args the information to be passed on to the method call
     * @return result from function called, or error
     */
    private function _callControllerFunction($controller, $function = "Index", $args = array()) {
        if(method_exists($controller, $function)) {
            return $controller->$function($args);
        } else {
            return $this->_callControllerError();
        }
    }
    
    /**
     * Show an error when caused by referencing a controller
     */
    private function _callControllerError() {
        echo "ERROR!";
    }
    
    /**
     * Show an error when caused by referencing a controller function
     */
    private function _callControllerFunctionError() {
        echo "function ERROR!";
    }
}

?>