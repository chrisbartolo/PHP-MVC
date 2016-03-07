<?php
/**
 * this is where we store the available and allowed constants to be used throughout the system
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

class VarsConfig {
    
    /**
     * the allowed output formats when displaying information to the user/browser
     * @var array 
     */
    static $output_formats = array (
        0 => "HTML",
        1 => "JSON"
    );
    
    /**
     *the allowed access controls for modifying data
     * @var array 
     */
    static $access_control = array (
        0 => "NONE",
        1 => "READ",
        2 => "WRITE",
        3 => "DELETE"
    );
    
    static $translatable_languages = array (
        0 => "en",
        1 => "sv",
        2 => "de"
    );
}