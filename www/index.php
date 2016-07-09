<?php
/**
 * Redline
 *
 * Push your dealership to the limit with Redline, a dealer management system that easily allows
 * you to track your dealership's performance across the entire business. From inventory & sales to
 * parts & services, Redline is the tool you need to streamline your operations & maximize the
 * revenue you and your team deserve.
 *
 * @author Nick Niebaum <nickniebaum@gmail.com>
 * @copyright Copyright (c) 2016, Synapse Development
 * @license http://nickniebaum.com/redline/license
 * @link http://nickniebaum.com/redline
 * @version 1.0.0
 * @since 1.0.0
 *
 * @todo Add license information to the end of the description.
 * 
 * @package Redline
 */

// ------------------------------------------------------------------------------------------------
//  REDLINE PATH
// ------------------------------------------------------------------------------------------------
// 
//  You must set the relative or absolute server path to the Redline directory below.
//  
// ------------------------------------------------------------------------------------------------
$redline_path='../redline';

// ------------------------------------------------------------------------------------------------
//  ENVIRONMENT
// ------------------------------------------------------------------------------------------------
// 
//  You can load different configurations depending on your current environment. Setting the
//  environment also influences things like logging and error reporting. This can be set to
//  anything, but default usage is:
//  
//      development
//      testing
//      production
//  
//  If you change these, also change the error_reporting() code below.
//  
// ------------------------------------------------------------------------------------------------
define('ENVIRONMENT','development');

// ------------------------------------------------------------------------------------------------
//  ERROR REPORTING
// ------------------------------------------------------------------------------------------------
// 
//  Different environments will require different levels of error reporting. By default
//  development will show errors but testing and live will hide them.
//  
// ------------------------------------------------------------------------------------------------
switch (ENVIRONMENT)
{
    case 'development':
        error_reporting(-1);
        ini_set('display_errors',1);
    break;

    case 'testing':
    case 'production':
        ini_set('display_errors',0);
        if (version_compare(PHP_VERSION,'5.3','>='))
        {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        }
        else
        {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
    break;

    default:
        header('HTTP/1.1 503 Service Unavailable.',TRUE,503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

// ------------------------------------------------------------------------------------------------
//  OUTPUT CHARACTERS
// ------------------------------------------------------------------------------------------------
// 
//  You can change how the system outputs new line and tab characters below.
//  
// ------------------------------------------------------------------------------------------------

    /**
     * New line character.
     */
    define('NEWLINE',"\r\n");

    /**
     * Tab character.
     */
    define('TAB','    ');

// ----------------------------------------------------------------------------
//  (!) End configuration - see documentation to complete your installation.
// ----------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// 
//  FRONT CONTROLLER
//  
// ------------------------------------------------------------------------------------------------
//  Define system constants and load the CodeIgniter bootstrap file.
// ------------------------------------------------------------------------------------------------

    // Set the current directory correctly for CLI requests
    if (defined('STDIN'))
    {
        chdir(dirname(__FILE__));
    }

// ----------------------------------------------------------------------------
//  REDLINE_PATH - Redline directory path.
// ----------------------------------------------------------------------------

    // Resolve relative paths and symlinks
    $redline_path=( $_temp=realpath($redline_path) )!==FALSE ? $_temp : $redline_path;

    // Clean up path
    $redline_path=str_replace('\\','/',$redline_path);
    $redline_path=rtrim($redline_path,'/');

    /**
     * Redline directory path.
     */
    define('REDLINE_PATH',$redline_path.'/');

    // Confirm path exists
    if (!is_dir(REDLINE_PATH))
    {
        header('HTTP/1.1 503 Service Unavailable.',TRUE,503);
        echo 'Your Redline path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__,PATHINFO_BASENAME);
        exit(3); // EXIT_CONFIG
    }

// ----------------------------------------------------------------------------
//  FCPATH - CodeIgniter front controller path.
//  SELF   - CodeIgniter front controller file name.
// ----------------------------------------------------------------------------

    /**
     * Front controller path.
     */
    define('FCPATH',dirname(__FILE__).'/');

    /**
     * Front controller file name.
     */
    define('SELF',pathinfo(__FILE__,PATHINFO_BASENAME));

// ----------------------------------------------------------------------------
//  BASEPATH - CodeIgniter system directory path.
//  SYSDIR   - CodeIgniter system directory name.
// ----------------------------------------------------------------------------

    /**
     * CodeIgniter system directory path.
     */
    define('BASEPATH',REDLINE_PATH.'system/framework/');

    /**
     * CodeIgniter system directory name.
     */
    define('SYSDIR',ltrim(strrchr(rtrim( BASEPATH,'/'),'/'),'/'));

    // Confirm path exists
    if (!is_dir(BASEPATH))
    {
        header('HTTP/1.1 503 Service Unavailable.',TRUE,503);
        echo 'Your CodeIgniter system path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__,PATHINFO_BASENAME);
        exit(3); // EXIT_CONFIG
    }

// ----------------------------------------------------------------------------
//  APPPATH - CodeIgniter application directory path.
// ----------------------------------------------------------------------------

    /**
     * CodeIgniter application directory path.
     */
    define('APPPATH',REDLINE_PATH.'system/application/');

    // Confirm path exists
    if (!is_dir(APPPATH))
    {
        header('HTTP/1.1 503 Service Unavailable.',TRUE,503);
        echo 'Your CodeIgniter application path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__,PATHINFO_BASENAME);
        exit(3); // EXIT_CONFIG
    }

// ----------------------------------------------------------------------------
//  VIEWPATH - CodeIgniter view directory path.
// ----------------------------------------------------------------------------

    /**
     * CodeIgniter views directory path.
     */
    define('VIEWPATH',APPPATH.'views/');

    // Confirm path exists
    if (!is_dir(VIEWPATH))
    {
        header('HTTP/1.1 503 Service Unavailable.',TRUE,503);
        echo 'Your CodeIgniter view path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__,PATHINFO_BASENAME);
        exit(3); // EXIT_CONFIG
    }

// ----------------------------------------------------------------------------
//  Load the CodeIgniter bootstrap file
// ----------------------------------------------------------------------------
    require_once BASEPATH.'core/CodeIgniter.php';