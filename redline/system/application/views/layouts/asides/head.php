<?php
/*
| -------------------------------------------------------------------
|  Set Page Title
| -------------------------------------------------------------------
*/
echo '<title>'.$title.'</title>';

/*
| -------------------------------------------------------------------
|  Embed Meta Tags
| -------------------------------------------------------------------
*/
echo meta(array_merge(array(
    array(
        'name'=>'Content-type',
        'content'=>'text/html; charset=utf-8',
        'type'=>'equiv',
    ),
    array(
        'name'=>'X-UA-Compatible',
        'content'=>'IE=edge,chrome=1',
        'type'=>'equiv',
    ),
    array(
        'name'=>'viewport',
        'content'=>'width=device-width, initial-scale=1',
    ),
),$meta));

/*
| -------------------------------------------------------------------
|  Fav Icon
| -------------------------------------------------------------------
*/
if(asset_exists('img/application/favicon.png'))
{
    echo link_tag(asset('img/application/favicon.png'),'shortcut icon','image/png');
}

/*
| -------------------------------------------------------------------
|  Load Stylesheets
| -------------------------------------------------------------------
*/
echo css($css);

/*
| -------------------------------------------------------------------
|  Load Header Javascript
| -------------------------------------------------------------------
*/
echo js($header_js);