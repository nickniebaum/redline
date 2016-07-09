<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('parse_string'))
{
    function parse_string($str,$data)
    {
        $CI=get_instance();
        $CI->load->library('parser');
        return $CI->parser->parse_string($str,$data,TRUE);
    }
}

if(!function_exists('forward_slashes'))
{
    function forward_slashes($str)
    {
        return str_replace('\\','/',$str);
    }
}

if(!function_exists('back_slashes'))
{
    function back_slashes($str)
    {
        return str_replace('/','\\',$str);
    }
}

if(!function_exists('normalize_path'))
{
    function normalize_path($path,$use_backslashes=FALSE)
    {
        $path=$use_backslashes ? back_slashes($path) : forward_slashes($path);
        return reduce_double_slashes($path);
    }
}

if(!function_exists('lipsum'))
{
    function lipsum($words=250)
    {
        $word_list=array('lorem','ipsum','dolor','sit','amet','consectetur','adipiscing','elit','aenean','tincidunt','ante','eu','accumsan','mattis','mauris','felis','laoreet','lectus','et','blandit','nunc','non','duis','ultricies','eros','finibus','enim','ut','feugiat','nibh','sed','porta','mollis','integer','nulla','dignissim','consequat','maecenas','libero','lacus','sagittis','eleifend','metus','leo','bibendum','quis','odio','at','iaculis','lacinia','urna','praesent','vel','gravida','aliquam','massa','purus','dapibus','ac','quam','donec','sem','mi','imperdiet','viverra','lobortis','fringilla','tristique','tempor','cras','euismod','ullamcorper','eget','in','class','aptent','taciti','sociosqu','ad','litora','torquent','per','conubia','nostra','inceptos','himenaeos','est','id','a','nisl','porttitor','tellus','vitae','varius','sapien','tempus','convallis','vivamus','arcu','elementum','vestibulum','sollicitudin','nisi','etiam','hendrerit','neque','pellentesque','orci','justo','velit','nullam','posuere','maximus','dui','rhoncus','pretium','ligula','semper','risus','turpis','tortor');

        $word_count=0;
        $sentences_word_count=array();

        while($word_count != $words)
        {
            $this_sentence=rand(10,30);

            if($word_count+$this_sentence > $words)
            {
                $this_sentence=$words-$word_count;
            }
            
            $sentences_word_count[]=$this_sentence;
            $word_count+=$this_sentence;
        }

        $sentences_words=array();

        foreach($sentences_word_count as $swc)
        {
            $this_sentence=array();

            while(count($this_sentence) < $swc)
            {
                $this_sentence[]=$word_list[rand(0,count($word_list)-1)];
            }

            $this_sentence[0]=ucfirst($this_sentence[0]);
            $this_sentence[count($this_sentence)-1].='.';

            $sentences_words[]=$this_sentence;
        }

        $sentences=array();

        foreach($sentences_words as $sentence)
        {
            $sentences[]=implode(' ',$sentence);
        }

        return implode(' ',$sentences);
    }
}