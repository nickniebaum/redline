<?php
defined('BASEPATH') OR exit('No direct script access allowed');

return array(
    'name'=>'Redline',
    'description'=>'Core system functionality for Redline.',
    'version'=>'1.0.0',
    // 'dependencies'=>array(
    //     'fees', // Module fees (no version dependency)
    //     'leads'=>'>=1.0.1', // Module leads (1.0.1 or newer)
    //     'sales'=>'<2.0.0', // Module sales (older than 2.0.0)
    // ),
    'conflicts'=>array(
        'core2'
    ),
);