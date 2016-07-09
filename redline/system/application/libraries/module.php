<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module
{
    public $key;

    protected $_config;

    public function __construct()
    {
        $this->_CI=get_instance();
    }

    public function check_dependencies()
    {
        // Ensure $_config['dependencies'] are installed in module table
    }

    public function install()
    {
        // Use the dbforge library to upgrade database 
    }

    public function install_database()
    {
        // Use the dbforge library to upgrade database 
    }

    public function install_data()
    {
        // Use the dbforge library to upgrade database 
    }

    public function uninstall()
    {
        // Use the dbforge library to downgrade database
    }
}