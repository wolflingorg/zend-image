<?php

class Zend_Image_Driver_Gd 
{

    function __construct( ) 
    {
        /* cursor */
    }

    /**
     * Load image from $fileName
     *
     * @param string $fileName Path to image
     */
    public function load( $fileName ) 
    {
        $info = getimagesize( $fileName );
    //    $this->_image = imageCreateTrueColor();
        switch( $info[2] )
        {
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


    /**
     * Binary image contents
     *
     * @type resource
     */
    private $_image;
}
