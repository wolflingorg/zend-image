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
 * @version   $Id: ImageTest.php 33 2010-01-23 13:15:15Z s.seletskiy $
 */

/**
 * For single test run.
 */
if( ! defined( 'PHPUnit_MAIN_METHOD' ) ) {
    define( 'PHPUnit_MAIN_METHOD', 'Zend_Image_Driver_GdTest::main' );
}

/**
 * Test helper.
 */
require_once dirname( __FILE__ ) . '/../../../TestHelper.php';

/**
 * @see Zend_Image
 */
require_once 'Zend/Image/Driver/Gd.php'; 

/**
 * @category   Zend
 * @package    Zend_Image
 * @subpackage UnitTests
 * @author     Seletskiy Stanislav <s.seletskiy@office.ngs.ru>
 * @author     Leonid Shagabutdinov <leonid@shagabutdinov.com>
 * @copyright  2010 NGS
 */
class Zend_Image_Driver_GdTest extends PHPUnit_Framework_Testcase
{
    public function __construct()
    {
        $this->_fileName = dirname( __FILE__ ) . '/' . $this->_fileName;
        $this->_fileNameCropped = dirname( __FILE__ ) . '/' . $this->_fileNameCropped;
        $this->_fileNameResized = dirname( __FILE__ ) . '/' . $this->_fileNameResized;
    }


    public static function main()
    {
        $suite = new PHPUnit_Framework_TestSuite( __CLASS__ );
        $result = PHPUnit_TextUI_TestRunner::run( $suite );
    }


    public function testCanLoadImage()
    {
        $driver = new Zend_Image_Driver_Gd();

        $this->assertEquals( false, $driver->isImageLoaded() );
        $driver->load( $this->_fileName );
        $this->assertEquals( true, $driver->isImageLoaded() );

    }


    public function testRaiseExceptionOnNonExistentFile()
    {
        $driver = new Zend_Image_Driver_Gd();

        try {
            $driver->load( 'non-existent-file-name' );
        } catch ( Zend_Image_Driver_Exception $e ) {
            return;
        }

        $this->fail( 'Expected exception wasn\'n raised' );
    }


    public function testCanGetSize()
    {
        $driver = new Zend_Image_Driver_Gd();
        $driver->load( $this->_fileName );

        $imageSize = getimagesize( $this->_fileName );
        $this->assertEquals(
            array( $imageSize[ 0 ], $imageSize[ 1 ] ),
            $driver->getSize()
        );
    }


    public function testCanGetBinary()
    {
        $driver = new Zend_Image_Driver_Gd();
        $driver->load( $this->_fileName );

        $this->assertEquals(
            md5_file( $this->_fileName ),
            md5( $driver->getBinary() )
        );
    }


    public function testCanResize()
    {
        $driver = new Zend_Image_Driver_Gd();
        $driver->load( $this->_fileName );

        $driver->resize( 100, 200 );
        $this->assertEquals(
            md5_file( $this->_fileNameResized ),
            md5( $driver->getBinary() )
        );
    }


    public function testCanCrop()
    {
        $driver = new Zend_Image_Driver_Gd();
        $driver->load( $this->_fileName );

        $driver->crop( 10, 20, 30, 40 );
        $this->assertEquals(
            md5_file( $this->_fileNameCropped ),
            md5( $driver->getBinary() )
        );
    }

    public function testRaiseExceptionOnSavingEmptyFile()
    {
        $driver = new Zend_Image_Driver_Gd();

        try {
            $driver->save( 'test.jpeg' );
        } catch ( Zend_Image_Driver_Exception $e ) {
            return true;
        }
        $this->fail( 'Expected exception wasn\'n raised' );
    }

    public function testCanSave() 
    {
        $fileNameTarget = tempnam( sys_get_temp_dir(), 'gd2test_' );

        if ( !is_writable( dirname( $fileNameTarget ) ) ) {
            $this->markTestSkipped( 
                'Temporary file "' . $fileNameTarget .'" is not writable' 
            );
        }

        if ( file_exists( $fileNameTarget ) && !is_writable( $fileNameTarget ) ) {
            $this->markTestSkipped( 
                'Temporary file "' . $fileNameTarget .'" is not writable' 
            );
        } else {
            unlink( $fileNameTarget );
        }

        $driver = new Zend_Image_Driver_Gd();
        $driver->load( $this->_fileName );
        $driver->save( $fileNameTarget );

        $this->assertEquals(
            md5_file( $this->_fileName ),
            md5_file( $fileNameTarget )
        );

        if ( file_exists( $fileNameTarget ) ) {
            unlink( $fileNameTarget );
        }

    }

    /**
     * @var string
     */
    private $_fileName = '_files/205x154.jpg';


    /**
     * @var string
     */
    private $_fileNameResized = '_files/100x200.jpg';


    /**
     * @var string
     */
    private $_fileNameCropped = '_files/30x40.jpg';

}
if( PHPUnit_MAIN_METHOD == 'Zend_Image_Driver_GdTest::main' ) {
    Zend_Image_Driver_GdTest::main();
}
