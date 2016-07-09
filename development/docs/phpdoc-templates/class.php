<?php defined('REDLINE') or exit;

/**
 * Summary.
 *
 * Description.
 *
 * @author Nick Niebaum <nickniebaum@gmail.com>
 * @copyright Copyright (c) 2016, Synapse Development
 * @license http://nickniebaum.com/redline/license
 * @link http://nickniebaum.com/redline
 * @version 1.0.0
 * @since 1.0.0
 *
 * @package Redline\{System|Modules}\{Core|Controllers|Libraries|Models|Modules|Configuration|Helpers|Hooks}
 * @subpackage {Users|Vehicles|Sales|Settings}
 */
class ClassName
{
    /**
     * @var string $property1 Short description.
     * @var integer $property2 Short description.
     */
    public $property1,
           $property2;

    /**
     * @var array $property3 Short description.
     */
    public $property3;
    /**
     * @var boolean $property4 Short description.
     */
    public $property4;

    /**
     * Short description.
     *
     * @since 0.0.1
     * 
     * @param  string $param1 Short description.
     * @param  integer $param2 Short description.
     * @param  boolean $param3 Short description.
     * 
     * @return boolean Short description.
     */
    public function method1($param1, $param2, $param3)
    {
        return is_string($param1) && is_int($param2) && is_bool($param3);
    }
}