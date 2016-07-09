<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Vendor Settings
| -------------------------------------------------------------------
| Defines collections of CSS and Javascript files that can be loaded
| by the controller using a key.
|
|     $default_css_settings=array(
|         
|     );
|
|     $default_js_settings=array(
|         'header'=>FALSE,
|     );
|
*/
$config['vendor_settings']=array(
    /*
    ''=>array(
        'css'=>array(

        ),
        'js'=>array(

        ),
    ),
    */
    'jquery'=>array(
        'js'=>array(
            'jquery-1.11.3.min.js',
            // 'jquery-2.1.4.min.js',
        ),
    ),
);