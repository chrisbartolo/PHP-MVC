<?php
/**
 * this is where we store the default settings. We can make these settings all set dynamically from the database later on
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

class DefaultsConfig {
    
    /**
     * the allowed output formats when displaying information to the user/browser
     * @var int 0 = HTML is default
     */
    static $output_format = 0; 
    
    /**
     * the allowed access method for unset page permissions
     * @var int 0 = NONE is default
     */
    static $access_control = 1; 
    
    /**
     * the default language for the system
     * @var type 
     */
    static $language = 0;
}