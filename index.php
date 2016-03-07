<?php
/**
 * this is the index file which should be used as the initiator for all calls in the system
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

// set to show all errors and warning in the browser
error_reporting(E_ALL);
ini_set('display_errors', '1');

// start the session
session_start();


define('__ROOT_PATH__', realpath(dirname(__FILE__) . '/../www'));

require_once(__ROOT_PATH__. "/Config/PathsConfig.php");

/**
 * The function used to load classes required and called throughout the code
 * @param string $className
 */
function __autoload($className) {
    if (strlen($className) > 6 && substr($className, -6) == 'Config') {
        if(file_exists(__CONFIG_PATH__ . $className . '.php')) {
            require_once( __CONFIG_PATH__ . $className . '.php' );
        }
    } else if (strlen($className) > 10 && substr($className, -10) == 'Controller') {
        if(file_exists(__CONTOLLER_PATH__ . $className . '.php')) {
            require_once( __CONTOLLER_PATH__ . $className . '.php' );
        }
    } if (strlen($className) > 4 && substr($className, -4) == 'Base') { 
        if(file_exists(__BASE_PATH__ . $className . '.php')) {
            require_once( __BASE_PATH__ . $className . '.php' );
        }
    } else if (strlen($className) > 5 && substr($className, -5) == 'Model') { 
        if(file_exists(__MODEL_PATH__ . $className . '.php')) {
            require_once( __MODEL_PATH__ . $className . '.php' );
        }
    } else {
        if(file_exists(__LIB_PATH__ . $className . '.php')) {
            require_once( __LIB_PATH__ . $className . '.php' );
        }
    }
}

$Registry = new Registry();
$Registry->Template = new Template($Registry);
$Bootstrap = new Bootstrap($Registry);

$Bootstrap->parseURL();

?>