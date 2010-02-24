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

class Zend_Image_Driver_Gd extends Zend_Image_Driver_Abstract
{
    /**
     * Load image from $fileName
     *
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
                $this->_imageLoaded = $this->_image !== false;
                break;
        }
    }


    public function getSize()
    {
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
        ob_start();
        imagejpeg( $this->_image );
        return ob_get_clean();
    }


    public function save( $file )
    {
         if ( !$this->_image ) {
             throw new Zend_Image_Driver_Exception(
                 'Trying to save image while it not loaded'
             );
         }

        imagejpeg( $this->_image, $file );
    }

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
     * Binary image contents
     *
     * @type resource
     */
    private $_image;
}
