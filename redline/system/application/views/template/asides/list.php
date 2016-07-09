<?php
    // Default usage:
    // $this->load->view('template/asides/list',array(
    //     'type'=>'u',
    //     'depth'=>3,
    //     'count'=>array(10,5,2),
    // ));
    
    // Set default view variables
    $type=isset($type) ? $type : 'u';
    $depth=isset($depth) ? $depth : 3;
    $count=isset($count) ? $count : array(10,5,2);

    // Get nested array of list items
    $list=build_list($depth,$count);

    // Output the list
    echo $type=='o' ? ol($list) : ul($list);