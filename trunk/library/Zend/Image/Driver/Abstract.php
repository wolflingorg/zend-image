<?php

/**
 * @see Zend_Image_Driver_Exception
 */
require_once 'Zend/Image/Driver/Exception.php';

/**
 * @see Zend_Image_Driver_Interface
 */
require_once 'Zend/Image/Driver/Interface.php';


/**
 * Abstract class for drivers
 *
 * @category    Zend
 * @package     Zend_Image
 * @subpackage  Zend_Image_Driver
 * @author      Stanislav Seletskiy <s.seletskiy@office.ngs.ru>
 * @author      Leonid A Shagabutdinov <leonid@shagabutdinov.com>
 * @copyright   2010 NGS
 */
abstract class Zend_Image_Driver_Abstract implements Zend_Image_Driver_Interface
{
    public function load( $fileName )
    {
        throw new Zend_Image_Driver_Exception(
            'Method "load" must be implemented'
        );
    }

    public function resize( $width, $height )
    {
        if ( $width <= 0 ) {
            throw new Zend_Image_Driver_Exception( 
                'Width can not be null or negative'
            );
        }

        if ( $height <= 0 ) {
            throw new Zend_Image_Driver_Exception( 
                'Height can not be null or negative'
            );
        }
    }


    public function crop( $left, $top, $targetWidth, $targetHeight )
    {
        if ( $left < 0 ) {
            throw new Zend_Image_Driver_Exception(
                "Trying to crop from ($left, $top). Offset can't " .
                    "been negative."
            );
        }

        if ( $top < 0 ) {
            throw new Zend_Image_Driver_Exception(
                "Trying to crop from ($left, $top). Offset can't " .
                    "been negative."
            );
        }

        list( $sourceWidth, $sourceHeight ) = $this->getSize();

        if ( $top + $targetHeight > $sourceHeight ) {
            throw new Zend_Image_Driver_Exception(
                'Trying to crop to (' . ( $left + $targetWidth ) . ', ' .
                    ( $top + $targetHeight ) . '). Out of bottom bound.'
            );
        }

        if ( $left + $targetWidth > $sourceWidth ) {
            throw new Zend_Image_Driver_Exception(
                'Trying to crop to (' . ( $left + $targetWidth ) . ', ' .
                    ( $top + $targetHeight ) . '). Out of right bound.'
            );
        }

        if ( $targetHeight <= 0 ) {
            throw new Zend_Image_Driver_Exception(
                'Target height can not be 0 or negative'
            );
        }

        if ( $targetWidth <= 0 ) {
            throw new Zend_Image_Driver_Exception(
                'Target width can not be 0 or negative'
            );
        }
    }


    public function isImageLoaded()
    {
        return $this->_imageLoaded;
    }


    protected $_imageLoaded = false;
}
