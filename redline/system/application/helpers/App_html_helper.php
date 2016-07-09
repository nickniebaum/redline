<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('asset'))
{
    function asset($asset)
    {
        // Absolute or base URLs aren't prefixed
        if(substr($asset,0,7)=='http://' || substr($asset,0,8)=='https://' || $asset[0]=='/')
        {
            return $asset;
        }

        $assets_path=rtrim(get_instance()->config->item('assets_path','application'),'/');

        // Return prefixed asset path
        return $assets_path.'/'.$asset;
    }
}

if(!function_exists('asset_exists'))
{
    function asset_exists($asset)
    {
        // Assume absolute URLs exist
        if(substr($asset,0,7)=='http://' || substr($asset,0,8)=='https://')
        {
            return TRUE;
        }

        // Remove the prefixed slash
        $asset=ltrim(asset($asset),'/');

        // Determine if the file exists
        return file_exists($asset) && is_file($asset);
    }
}

if(!function_exists('css'))
{
    function css($href)
    {
        // Use recursion to build a string of <link> tags
        if(is_array($href))
        {
            $css_html='';

            foreach($href as $css_href)
            {
                $css_html.=css($css_href);
            }
        }
        // Build the <link> tag
        else
        {
            $css_html='<link rel="stylesheet" href="'.asset($href).'" />'.NEWLINE;
        }

        // Return the resulting HTML
        return $css_html;
    }
}

if(!function_exists('js'))
{
    function js($src)
    {
        // Use recursion to build a string of <script> tags
        if(is_array($src))
        {
            $js_html='';

            foreach($src as $js_src)
            {
                $js_html.=js($js_src);
            }
        }
        // Build the <script> tag
        else
        {
            $js_html='<script src="'.asset($src).'"></script>'.NEWLINE;
        }

        // Return the resulting HTML
        return $js_html;
    }
}