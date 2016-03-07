<?php
/**
 * this is the base controller
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

abstract class ModelBase {
    /**
     * The registry object
     */
    private $_Registry = null;
    
    /**
     * always initialise the base controller with the registry object wich holds all values
     */
    public function __construct($Registry) {
        $this->_Registry = $Registry;
    }
    
    /**
     * the default save function. All Models should have the ability to save details to the database
     * @param $args array
     */
    public abstract function save($args);
    
    /**
     * the default delete function. All Models should have the ability to delete details from the database
     * @param $args array
     */
    public abstract function delete($args);
   
}