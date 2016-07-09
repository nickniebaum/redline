<?php

    $count=isset($count) ? $count : 5;
    $attributes=isset($attributes) ? $attributes : '';

    $list=array();

    for($i=1;$i<=$count;$i++)
    {
        $list['Item Key '.$i]='Item Value '.$i;
    }

    echo definition_list($list,$attributes);