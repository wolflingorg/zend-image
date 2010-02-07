<?php

class Zend_Image_Driver_Gd 
{
    /**
     * Load image from $fileName
     *
     * @param string $fileName Path to image
     */
    public function load( $fileName )
    {
        $info = getimagesize( $fileName );
        switch( $info[ 2 ] ) {
            case IMAGETYPE_JPEG:
                $this->_image = imageCreateFromJpeg( $fileName );
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


    public function resize( $width, $height )
    {
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
