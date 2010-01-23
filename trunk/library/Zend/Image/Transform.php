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
 * @see Zend_Image
 */
require_once 'Zend/Image.php';

/**
 * @see Zend_Image_Transform_Exception
 */
require_once 'Zend/Image/Transform/Exception.php';


/**
 * @todo Negative values for crop.
 * @todo Asserts, that position methods are not called together.
 * @todo phpDoc descriptions.
 * @category  Zend
 * @package   Zend_Image
 * @copyright Copyright (c) 2010
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Zend_Image_Transform extends Zend_Image
{
    /**
     * Fits image to target width.
     *
     * @param   int $targetWidth Width to fit to.
     * @return  Zend_Image
     */
    public function fitToWidth( $targetWidth )
    {
        list( $widthSource, $heightSource ) = $this->_driver->getSize();
        $targetHeight = round( $heightSource / $widthSource * $targetWidth );

        if ( $targetHeight <= 0 ) {
            throw new Zend_Image_Transform_Exception( 'Target height can\'t be 0 or less' );
        }

        if ( $targetWidth <= 0 ) {
            throw new Zend_Image_Transform_Exception( 'Target width can\'t be 0 or less' );
        }

        $this->_driver->resize( $targetWidth, $targetHeight );
        return $this;
    }


    /**
     * Fits image to target height.
     *
     * @param   int $targetHeight Height to fit to.
     * @return  Zend_Image
     */
    public function fitToHeight( $targetHeight )
    {
        list( $sourceWidth, $sourceHeight ) = $this->_driver->getSize();
        $targetWidth = round( $sourceWidth / $sourceHeight * $targetHeight );

        if ( $targetWidth <= 0 ) {
            throw new Zend_Image_Transform_Exception( 'Target width can\'t be 0 or less' );
        }

        if ( $targetHeight <= 0 ) {
            throw new Zend_Image_Transform_Exception( 'Target height can\'t be 0 or less' );
        }

        $this->_driver->resize( $targetWidth, $targetHeight );
        return $this;
    }


    /**
     * Fits image into specified frame.
     *
     * @todo Description.
     * @param   int $targetWidth Frame width.
     * @param   int $targetHeight Frame height.
     * @return  Zend_Image
     */
    public function fitIn( $targetWidth, $targetHeight )
    {
        $targetRatio = $targetWidth / $targetHeight;
        list( $sourceWidth, $sourceHeight ) = $this->_driver->getSize();
        $sourceRatio = $sourceWidth / $sourceHeight;

        if ( $targetRatio < $sourceRatio ) {
            $this->fitToWidth( $targetWidth );
        } else {
            $this->fitToHeight( $targetHeight );
        }

        return $this;
    }


    /**
     * Fits image out of frame.
     *
     * @todo Description.
     * @param   $targetWidth int Frame width.
     * @param   $targetHeight int Frame height.
     * @return  Zend_Image
     */
    public function fitOut( $targetWidth, $targetHeight )
    {
        $targetRatio = $targetWidth / $targetHeight;
        list( $sourceWidth, $sourceHeight ) = $this->_driver->getSize();
        $sourceRatio = $sourceWidth / $sourceHeight;

        if ( $targetRatio > $sourceRatio ) {
            $this->fitToWidth( $targetWidth );
        } else {
            $this->fitToHeight( $targetHeight );
        }

        return $this;
    }


    /**
     * Offset from left border of image.
     *
     * @param   $leftOffset int Left offset.
     * @return  Zend_Image
     */
    public function left( $leftOffset = 0 )
    {
        $this->_leftOffset = intval( $leftOffset );
        return $this;
    }


    /**
     * Offset from right border of image.
     *
     * @param   $rightOffset int Right offset.
     * @return  Zend_Image
     */
    public function right( $rightOffset = 0 )
    {
        $this->_rightOffset = intval( $rightOffset );
        return $this;
    }


    /**
     * Offset from top border of image.
     *
     * @param   $topOffset int Top offset.
     * @return  Zend_Image
     */
    public function top( $topOffset = 0 )
    {
        $this->_topOffset = intval( $topOffset );
        return $this;
    }


    /**
     * Offset from bottom border of image.
     *
     * @param   $bottomOffset int Bottom offset.
     * @return  Zend_Image
     */
    public function bottom( $bottomOffset = 0 )
    {
        $this->_bottomOffset = intval( $bottomOffset );
        return $this;
    }


    /**
     * Sets crop position from horizontal center.
     *
     * @return  Zend_Image
     */
    public function center()
    {
        $this->_center = true;
        return $this;
    }


    /**
     * Sets crop position from vertical middle.
     *
     * @return  Zend_Image
     */
    public function middle()
    {
        $this->_middle = true;
        return $this;
    }


    /**
     * Crops image from specified by left(), top(), bottom() or right() point.
     *
     * @param   $width int Width of cropped image.
     * @param   $height int Height of cropped image.
     * @return  Zend_Image
     */
    public function crop( $width, $height )
    {
        if ( $this->_leftOffset > 0 ) {
            $leftOffset = $this->_leftOffset;
        } else if ( $this->_rightOffset > 0 ) {
            $leftOffset = $this->getWidth() - $this->_rightOffset;
        } else {
            $leftOffset = 0;
        }

        if ( $this->_topOffset > 0 ) {
            $topOffset = $this->_topOffset;
        } else if ( $this->_bottomOffset > 0 ) {
            $topOffset = $this->getHeight() - $this->_bottomOffset;
        } else {
            $topOffset = 0;
        }

        if ( $this->_center ) {
            $leftOffset = round( ( $this->getWidth() - $width ) / 2 );
        }

        if ( $this->_middle ) {
            $topOffset = round( ( $this->getHeight() - $height ) / 2 );
        }

        $this->_driver->crop( $leftOffset, $topOffset, $width, $height );

        return $this;
    }




    private $_topOffset = 0;
    private $_bottomOffset = 0;
    private $_leftOffset = 0;
    private $_rightOffset = 0;

    private $_center = false;
    private $_middle = false;
}
