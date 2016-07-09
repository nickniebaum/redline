<?php

$config['environment']='development';

$config['display_errors']=array(
    'development'=>TRUE,
    'testing'=>TRUE,
    'production'=>FALSE,
);

$config['error_reporting']=array(
    'development'=>-1,
    'testing'=>E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED,
    'production'=>E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED,
);

$config['newline_char']="\r\n";
$config['tab_char']='    ';