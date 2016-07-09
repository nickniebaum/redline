<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function autoload($classname)
{
    static $paths;

    // Set $paths if it has not been set yet
    if(!isset($paths))
    {
        global $CFG;

        if($CFG->item('application')===FALSE)
        {
            $CFG->load('application',TRUE);
        }

        $paths=$CFG->item('autoload_paths','application');

        // Ensure a trailing slash on all paths
        foreach($paths as $i=>$path)
        {
            $paths[$i]=rtrim($path,'/\\').'/';
        }
    }

    foreach($paths as $path)
    {
        if(file_exists($path.$classname.'.php'))
        {
            require_once($path.$classname.'.php');
        }
    }
}

function register_autoloader($classname)
{
    spl_autoload_register('autoload');
}