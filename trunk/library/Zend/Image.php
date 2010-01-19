<?php

/**
 * Zend Image
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category   Zend
 * @package    Zend_Image
 * @author     Stanislav Seletskiy <s.seletskiy@gmail.com>
 * @author     Leonid Shagabutdinov <leonid@shagabutdinov.com>
 * @copyright  Copyright (c) 2010
 * @license    http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version    $Id: $
 */

/**
 * @see Zend_Image_Driver_Interface
 */
require_once 'Zend/Image/Driver/Inteface.php';

/**
 * Base class for loading and saving images.
 *
 * @category   Zend
 * @package    Zend_Image
 * @copyright  Copyright (c) 2010
 * @license    http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Zend_Image
{
    /**
     * Constructor for image.
     *
     * @param  mixed $filename Filename, Zend_Image or binary.
     * @param  Zend_Image_Driver_Interface $driver Driver for image operations.
     */
    public function __construct( $filename, Zend_Image_Driver_Interface $driver )
    {
        $this->_driver = $driver;
        $this->load( $filename );
    }


    /**
     * Loads specified file, or Zend_Image or binary as
     * image source.
     *
     * @param  $filename Filename, Zend_Image or binary.
     * @return
     */
    public function load( $filename )
    {
        $this->_filename = $filename;
        $this->_driver->load( $this->_filename );
        return $this;
    }


    /**
     * Filename of image source.
     *
     * @var string
     */
    private $_filename = '';


    /**
     * Driver for image operations.
     *
     * @var Zend_Image_Driver
     */
    private $_driver = null;
}
