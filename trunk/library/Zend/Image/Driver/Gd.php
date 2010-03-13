<?php

/**
 * @see Zend_Image_Driver_Interface
 */
require_once 'Zend/Image/Driver/Interface.php';

/**
 * @see Zend_Image_Driver_Exception
 */
require_once 'Zend/Image/Driver/Exception.php';


/**
 * @see Zend_Image_Driver_Abstract
 */
require_once 'Zend/Image/Driver/Abstract.php';

/**
 * GdImage driver
 *
 * @category    Zend
 * @package     Zend_Image
 * @subpackage  Zend_Image_Driver
 * @author      Leonid A Shagabutdinov <leonid@shagabutdinov.com>
 * @author      Stanislav Seletskiy <s.seletskiy@office.ngs.ru>
 */
class Zend_Image_Driver_Gd extends Zend_Image_Driver_Abstract
{
    /**
     * Load image from $fileName
     *
     * @throws Zend_Image_Driver_Exception
     * @param string $fileName Path to image
     */
    public function load( $fileName )
    {
        $this->_imageLoaded = false;
        if ( ! file_exists( $fileName ) ) {
            throw new Zend_Image_Driver_Exception( 'File "' . $fileName . '" not exists.' );
        }

        $info = getimagesize( $fileName );
        switch( $info[ 2 ] ) {
            case IMAGETYPE_JPEG:
                $this->_image = imageCreateFromJpeg( $fileName );
                if ( $this->_image !== false ) {
                    $this->_imageLoaded = true;
                }
                break;
        }
    }


    /**
     * Get image size
     *
     * @throws Zend_Image_Driver_Exception
     * @return array Format: array( width, height )
     */
    public function getSize()
    {
        if( $this->_image === null ) {
            throw new Zend_Image_Driver_Exception(
                'Trying to get size of non-loaded image'
            );
        }

        return array(
            imagesx( $this->_image ),
            imagesy( $this->_image )
        );
    }


    /**
     * Get image contents
     *
     * @return string
     */
    public function getBinary()
    {
        if( $this->_image === null ) {
            throw new Zend_Image_Driver_Exception(
                'Trying to get size of non-loaded image'
            );
        }
        
        ob_start();
        imagejpeg( $this->_image );
        return ob_get_clean();
    }


    /**
     *
     * @throws Zend_Image_Driver_Exception
     * @param string $file File name to save image
     */
    public function save( $file )
    {
         if ( !$this->_image ) {
             throw new Zend_Image_Driver_Exception(
                 'Trying to save non-loaded image'
             );
         }

        imagejpeg( $this->_image, $file );
    }


    /**
     * Resize image into specified width and height
     *
     * @throws Zend_Image_Driver_Exception
     * @param int $width Width to resize
     * @param int $height Height to resize
     * @return bool
     */
    public function resize( $width, $height )
    {
        parent::resize( $width, $height );

        $imageSize = $this->getSize();
        $resizedImage = imagecreatetruecolor( $width, $height );
        $successfull = imagecopyresized(
            $resizedImage, $this->_image,
            0, 0,
            0, 0,
            $width, $height,
            $imageSize[ 0 ], $imageSize[ 1 ]
        );

        unset( $this->_image );
        $this->_image = $resizedImage;

        return $successfull;
    }

    
    /**
     * Crop image into specified frame
     *
     * @throws Zend_Image_Driver_Exception
     * @param int $left Left point to crop from
     * @param int $top Top point to crop from
     * @param int $width Width to crop
     * @param int $height Height to crop
     * @return bool
     */
    public function crop( $left, $top, $width, $height )
    {
        parent::crop( $left, $top, $width, $height );

        $imageSize = $this->getSize();
        $croppedImage = imagecreatetruecolor( $width, $height );
        $successfull = imagecopyresized(
            $croppedImage, $this->_image,
            0, 0,
            $left, $top,
            $width, $height,
            $left + $width, $top + $height
        );

        unset( $this->_image );
        $this->_image = $croppedImage;

        return $successfull;

    }


    /**
     * Link to gd-image resource
     *
     * @type resource
     */
    private $_image = null;
}
