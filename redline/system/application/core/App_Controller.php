<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * A base controller for CodeIgniter with view autoloading, layout support,
 * model loading, helper loading, asides/partials and per-controller 404
 *
 * @link http://github.com/jamierumbelow/codeigniter-base-controller
 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
 */

class App_Controller extends CI_Controller
{
    /**
     * The page title
     */
    protected $title;

    /**
     * An array of meta tags to embed
     */
    protected $meta=array();

    /**
     * An array of CSS stylesheets to load
     */
    protected $css=array(
        'css/application.css',
    );

    /**
     * An array of Javascript files to load
     */
    protected $js=array();

    /**
     * An array of Javascript files to load in the header
     */
    protected $header_js=array();

    /**
     * An array of front-end libraries to load
     */
    protected $vendor=array();

    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * The current request's view. Automatically guessed
     * from the name of the controller and action
     */
    protected $view = '';

    /**
     * An array of variables to be passed through to the
     * view, layout and any asides
     */
    protected $data = array();

    /**
     * The name of the layout to wrap around the view.
     */
    protected $layout='layouts/application';

    /**
     * An arbitrary list of asides/partials to be loaded into
     * the layout. The key is the declared name, the value the file
     */
    protected $asides = array(
        'head'=>'layouts/asides/head',
        'foot'=>'layouts/asides/foot',
    );

    /**
     * A list of models to be autoloaded
     */
    protected $models = array();

    /**
     * A formatting string for the model autoloading feature.
     * The percent symbol (%) will be replaced with the model name.
     */
    protected $model_string = '%_model';

    /**
     * A list of helpers to be autoloaded
     */
    protected $helpers = array();

    /* --------------------------------------------------------------
     * GENERIC METHODS
     * ------------------------------------------------------------ */

    /**
     * Initialise the controller, tie into the CodeIgniter superobject
     * and try to autoload the models and helpers
     */
    public function __construct()
    {
        parent::__construct();

        // Load the application configuration
        $this->load->config('application',TRUE);
        // Load the vendor library settings
        $this->load->config('vendor',TRUE);
        // Set the default meta tags
        $this->meta=array_merge($this->config->item('default_meta','application'),$this->meta);

        $this->_load_models();
        $this->_load_helpers();
    }

    /* --------------------------------------------------------------
     * VIEW RENDERING
     * ------------------------------------------------------------ */

    /**
     * Override CodeIgniter's despatch mechanism and route the request
     * through to the appropriate action. Support custom 404 methods and
     * autoload the view into the layout.
     */
    public function _remap($method)
    {
        if (method_exists($this, $method))
        {
            call_user_func_array(array($this, $method), array_slice($this->uri->rsegments, 2));
        }
        else
        {
            if (method_exists($this, '_404'))
            {
                call_user_func_array(array($this, '_404'), array($method));
            }
            else
            {
                show_404(strtolower(get_class($this)).'/'.$method);
            }
        }

        $this->_load_view();
    }

    /**
     * Sets data that is common to every view
     */
    protected function _load_data()
    {
        $data=array();

        $data['app_title']=$this->config->item('app_title','application');
        $data['page_title']=$this->title;
        $data['title']=parse_string($this->config->item('title_format','application'),array(
            'app_title'=>$this->config->item('app_title','application'),
            'page_title'=>$this->title,
        ));
        $data['uri_string']=implode('-',$this->uri->rsegment_array());
        $data['is_homepage']=( $data['uri_string']==='application-index' );
        $data['meta']=$this->meta;

        $this->_load_vendor_assets();

        $data['css']=$this->css;
        $data['js']=$this->js;
        $data['header_js']=$this->header_js;

        $this->data=array_merge($data,$this->data);
    }

    protected function _load_vendor_assets()
    {
        // Check if there are any vendor assets to load
        if(empty($this->vendor)) return;

        // Temporary arrays to hold assets
        $css=array();
        $js=array();
        $header_js=array();

        // URL to the vendor directory
        $vendor_url=$this->config->item('vendor_path','application');
        // File path to the vendor directory
        $vendor_path=normalize_path(FCPATH.$vendor_url);
        // Vendor asset settings
        $vendor_settings=$this->config->item('vendor_settings','vendor');

        foreach($this->vendor as $vendor_key)
        {
            $this_vendor_path=$vendor_path.'/'.$vendor_key;
            $this_vendor_url=$vendor_url.'/'.$vendor_key;

            // Check that settings exist
            if(!isset($vendor_settings[$vendor_key])) show_error('Vendor settings do not exist: '.$vendor_key);

            $this_vendor_settings=$vendor_settings[$vendor_key];

            // Check that directory exists
            if(!file_exists($this_vendor_path)) show_error('Vendor directory doesn\'t exist: '.$this_vendor_url);

            if(isset($this_vendor_settings['css']))
            {
                foreach($this_vendor_settings['css'] as $k=>$v)
                {
                    // No settings for CSS files yet, so this can be commented out
                    // if(is_array($v))
                    // {
                    //     $this_asset_url=$k;
                    //     $this_asset_settings=$v;
                    // }
                    // else
                    // {
                    //     $this_asset_url=$v;
                    //     $this_asset_settings=array();
                    // }

                    // Apply default settings
                    // $this_asset_settings=array_merge($this_asset_settings,array(
                        
                    // ));

                    $this_asset_url=$this_vendor_url.'/'.$v;

                    $css[]=$this_asset_url;
                }
            }

            if(isset($this_vendor_settings['js']))
            {
                foreach($this_vendor_settings['js'] as $k=>$v)
                {
                    if(is_array($v))
                    {
                        $this_asset_url=$this_vendor_url.'/'.$k;
                        $this_asset_settings=$v;
                    }
                    else
                    {
                        $this_asset_url=$this_vendor_url.'/'.$v;
                        $this_asset_settings=array();
                    }

                    // Apply default settings
                    $this_asset_settings=array_merge(array(
                        'header'=>FALSE,
                    ),$this_asset_settings);

                    if($this_asset_settings['header'])
                    {
                        $header_js[]=$this_asset_url;
                    }
                    else
                    {
                        $js[]=$this_asset_url;
                    }
                }
            }
        }

        $this->css=array_merge($css,$this->css);
        $this->js=array_merge($js,$this->js);
        $this->header_js=array_merge($header_js,$this->header_js);
    }

    /**
     * Automatically load the view, allowing the developer to override if
     * he or she wishes, otherwise being conventional.
     */
    protected function _load_view()
    {
        // If $this->view == FALSE, we don't want to load anything
        if ($this->view !== FALSE)
        {
            // Load common data
            $this->_load_data();

            // If $this->view isn't empty, load it. If it isn't, try and guess based on the controller and action name
            $view = (!empty($this->view)) ? $this->view : $this->router->directory . $this->router->class . '/' . $this->router->method;

            // Load the view into $yield
            $data['yield'] = $this->load->view($view, $this->data, TRUE);

            // Do we have any asides? Load them.
            if (!empty($this->asides))
            {
                foreach ($this->asides as $name => $file)
                {
                    $data['yield_'.$name] = $this->load->view($file, $this->data, TRUE);
                }
            }

            // Load in our existing data with the asides and view
            $data = array_merge($this->data, $data);
            $layout = FALSE;

            // If we didn't specify the layout, try to guess it
            if (!isset($this->layout))
            {
                if (file_exists(APPPATH . 'views/layouts/' . $this->router->class . '.php'))
                {
                    $layout = 'layouts/' . $this->router->class;
                }
                else
                {
                    $layout = 'layouts/application';
                }
            }

            // If we did, use it
            else if ($this->layout !== FALSE)
            {
                $layout = $this->layout;
            }

            // If $layout is FALSE, we're not interested in loading a layout, so output the view directly
            if ($layout == FALSE)
            {
                $this->output->set_output($data['yield']);
            }

            // Otherwise? Load away :)
            else
            {
                $this->load->view($layout, $data);
            }
        }
    }

    /* --------------------------------------------------------------
     * MODEL LOADING
     * ------------------------------------------------------------ */

    /**
     * Load models based on the $this->models array
     */
    private function _load_models()
    {
        foreach ($this->models as $model)
        {
            $this->load->model($this->_model_name($model), $model);
        }
    }

    /**
     * Returns the loadable model name based on
     * the model formatting string
     */
    protected function _model_name($model)
    {
        return str_replace('%', $model, $this->model_string);
    }

    /* --------------------------------------------------------------
     * HELPER LOADING
     * ------------------------------------------------------------ */

    /**
     * Load helpers based on the $this->helpers array
     */
    private function _load_helpers()
    {
        foreach ($this->helpers as $helper)
        {
            $this->load->helper($helper);
        }
    }
}

/* End of file App_Controller.php */
/* Location: ./application/core/App_Controller.php */