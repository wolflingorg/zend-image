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
 * @category  Zend
 * @package   Zend_Image
 * @copyright Copyright (c) 2010
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
interface Zend_Image_Driver_Interface
{
    /**
     * Load image from file name
     *
     * @throws Zend_Image_Driver_Exception
     * @param string $filename
     * @return bool
     */
    public function load( $filename );


    /**
     * Save image to filename
     *
     * @throws Zend_Image_Driver_Exception
     * @param string $filename
     * @return bool
     */
    public function save( $filename );


    /**
     * Get image contents
     *
     * @throws Zend_Image_Driver_Exception
     * @return string
     */
    public function getBinary();


    /**
     * Get image size as array(width, height)
     *
     * @throws Zend_Image_Driver_Exception
     * @return array Format: array(width, height)
     */
    public function getSize();


    /**
     * Resize image to specified coordinates
     *
     * @throws Zend_Image_Driver_Exception
     * @param int $width
     * @param int $height
     * @return bool
     */
    public function resize( $width, $height );


    /**
     * Crop image to specified coordinates
     *
     * @throws Zend_Image_Driver_Exception
     * @param int $left
     * @param itn $top
     * @param int $width
     * @param int $height
     * @return bool
     */
    public function crop( $left, $top, $width, $height );
}
