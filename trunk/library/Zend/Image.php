
<?php

/**
 * Zend Image
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category  Zend
 * @package   Zend_Image
 * @author    Stanislav Seletskiy <s.seletskiy@gmail.com>
 * @author    Leonid Shagabutdinov <leonid@shagabutdinov.com>
 * @copyright Copyright (c) 2010
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

/**
 * @see Zend_Image_Driver_Interface
 */
require_once 'Zend/Image/Driver/Inteface.php';

/**
 * Base class for loading and saving images.
 *
 * @category  Zend
 * @package   Zend_Image
 * @copyright Copyright (c) 2010
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Zend_Image
{
    /**
     * Constructor for image.
     *
     * @param mixed $filename Filename, Zend_Image or binary.
     * @param Zend_Image_Driver_Interface $driver Driver for image operations.
     */
    public function __construct( $filename, Zend_Image_Driver_Interface $driver = null )
    {
        if( ! $filename instanceof Zend_Image ) {
            $this->_driver = $driver;
        }

        $this->loadByFile( $filename );
    }


    /**
     * Loads specified file, or Zend_Image or binary as
     * image source.
     *
     * @param  mixed $filename Filename or instance of Zend_Image.
     * @return Zend_Image
     */
    public function loadByFile( $filename )
    {
        if( $filename instanceof Zend_Image ) {
            $this->_driver = clone $filename->getDriver();
        } else {
            $this->_filename = $filename;
            $this->_driver->loadByFile( $this->_filename );
        }

        return $this;
    }

    /**
     * Save image to file to disk.
     *
     * @return bool
     */
    public function save ( $filename )
    {
        return $this->_driver->save( $filename );
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
    protected $_driver = null;


    /**
     * @return Zend_Image_Driver_Interface
     */
    public function getDriver()
    {
        return $this->_driver;
    }


    /**
     * Get image is binary.
     *
     * @return binary
     */
    public function getImageAsBinary()
    {
        return $this->_driver->getImageAsBinary();
    }


    /**
     * Returns width of image.
     *
     * @return int Width of image.
     */
    public function getWidth()
    {
        $size = $this->_driver->getSize();
        return $size[ 0 ];
    }


    /**
     * Returns height of image.
     *
     * @return int Height of image.
     */
    public function getHeight()
    {
        $size = $this->_driver->getSize();
        return $size[ 1 ];
    }
}
