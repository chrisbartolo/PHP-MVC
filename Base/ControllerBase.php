<?php
/**
 * this is the base controller
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

abstract class ControllerBase {
    /*
     * The registry object
     */
    private $_Registry = null;
    
    /*
     * always initialise the base controller with the registry object wich holds all values
     */
    public function __construct($Registry) {
        $this->_Registry = $Registry;
    }
    
    /*
     * a controller must always have an index function which is called by default
     */
    public abstract function index();
}