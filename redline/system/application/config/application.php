<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Title Settings
| -------------------------------------------------------------------
| The application title and formatting of page titles. The following
| keys are available to use:
|
|     {app_title}  The application title (set here)
|     {page_title} The page title (set by the action)
|
*/
$config['app_title']='Boilerplate';
$config['title_format']='{app_title} | {page_title}';

/*
| -------------------------------------------------------------------
|  Default Meta
| -------------------------------------------------------------------
| These are default meta tags that are sent with every request. They
| can also be changed dynamically at the controller and action level.
*/
$config['default_meta']=array(
    array(
        'name'=>'description',
        'content'=>'',
    ),
    array(
        'name'=>'keywords',
        'content'=>'',
    ),
    array(
        'name'=>'copyright',
        'content'=>'Copyright '.date('Y').' '.$config['app_title'].', All Rights Reserved',
    ),
    array(
        'name'=>'author',
        'content'=>'Nick Niebaum <nick@nickniebaum.com>',
    ),
);

/*
| -------------------------------------------------------------------
|  Assets Path
| -------------------------------------------------------------------
| The path that will be prefixed to any referenced asset file.
*/
$config['assets_path']='/assets';

/*
| -------------------------------------------------------------------
|  Vendor Path
| -------------------------------------------------------------------
| The path that contains front-end vendor libraries.
*/
$config['vendor_path']=$config['assets_path'].'/vendor';

/*
| -------------------------------------------------------------------
|  Autoload Paths
| -------------------------------------------------------------------
| The directory paths to attempt to autoload classes from.
*/
$config['autoload_paths']=array(
    APPPATH.'core',
);