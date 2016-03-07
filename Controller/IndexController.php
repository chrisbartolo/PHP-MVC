<?php
/**
 * this is the index controller for the system; here we handle the first initial call to the system, with blank parameters
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

class IndexController extends ControllerBase {
    public function __construct($Registry) {
        parent::__construct($Registry);
    }
    
    public function index() {
        echo "Called Index Index";
    }
}