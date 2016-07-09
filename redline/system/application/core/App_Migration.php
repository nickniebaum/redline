<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_Migration extends CI_Migration
{
    protected $_migration_types_supported=array(
        'sequential'=>'/^\d{3}_(\w+)$/',
        'timestamp'=>'/^\d{14}_(\w+)$/',
        'ordered'=>'/^\d{6}+_(\w+)$/',
    );

    public function __construct($config = array())
    {
        // Only run this constructor on main library load
        if ( ! in_array(get_class($this), array('CI_Migration', config_item('subclass_prefix').'Migration'), TRUE))
        {
            return;
        }

        foreach ($config as $key => $val)
        {
            $this->{'_'.$key} = $val;
        }

        log_message('info', 'Migrations Class Initialized');

        // Are they trying to use migrations while it is disabled?
        if ($this->_migration_enabled !== TRUE)
        {
            show_error('Migrations has been loaded but is disabled or set up incorrectly.');
        }

        // If not set, set it
        $this->_migration_path !== '' OR $this->_migration_path = APPPATH.'migrations/';

        // Add trailing slash if not set
        $this->_migration_path = rtrim($this->_migration_path, '/').'/';

        // Load migration language
        $this->lang->load('migration');

        // They'll probably be using dbforge
        $this->load->dbforge();

        // Make sure the migration table name was set.
        if (empty($this->_migration_table))
        {
            show_error('Migrations configuration file (migration.php) must have "migration_table" set.');
        }

// BEGIN / * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

        if(!isset($this->_migration_types_supported[ $this->_migration_type ]))
        {
            show_error('An invalid migration numbering type was specified: '.$this->_migration_type);
        }

        $this->_migration_regex=$this->_migration_types_supported[ $this->_migration_type ];

// END   / * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 

        // If the migrations table is missing, make it
        if ( ! $this->db->table_exists($this->_migration_table))
        {
            $this->dbforge->add_field(array(
                'version' => array('type' => 'BIGINT', 'constraint' => 20),
            ));

            $this->dbforge->create_table($this->_migration_table, TRUE);

            $this->db->insert($this->_migration_table, array('version' => 0));
        }

        // Do we auto migrate to the latest migration?
        if ($this->_migration_auto_latest === TRUE && ! $this->latest())
        {
            show_error($this->error_string());
        }
    }

// BEGIN / * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

    public function version($target_version)
    {
        if($this->_migration_type=='ordered' && preg_match('/^\d{1,2}\.\d{1,2}\.\d{1,2}$/',$target_version)!==FALSE)
        {
            $target_version=$this->_version_to_number($target_version);

            if($target_version===FALSE)
            {
                show_error('Unable to convert passed $target_version: '.$target_version.' in Migration::version()');
            }
        }
        
        return parent::version($target_version);
    }

    protected function _version_to_number($version,$width=2)
    {
        $r='';
        $arr=explode('.',$version);

        foreach($arr as $n)
            $r.=sprintf('%0'.$width.'d',$n);

        return strlen($r)==$width*3 ? $r : FALSE;
    }

    protected function _number_to_version($number,$width=2)
    {
        for($i=1,$arr=array();$i<=3;$i++)
            $arr[]=(int)substr($number,($i-1)*$width,$width);

        return implode('.',$arr);            
    }

// END   / * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 

}