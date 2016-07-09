<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends App_Controller
{
    protected $asides = array(
        'head'=>'layouts/asides/head',
        'foot'=>'layouts/asides/foot',
    );

    public function __construct()
    {
        parent::__construct();

        $this->js[]='vendor/jquery2/jquery-2.2.4.min.js';
        $this->js[]='vendor/bootstrap-sass/javascripts/bootstrap.js';
    }

    public function index()
    {
        $this->title='Template';
    }
}