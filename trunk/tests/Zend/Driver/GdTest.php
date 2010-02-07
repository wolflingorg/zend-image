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
    define( 'PHPUnit_MAIN_METHOD', 'Zend_ImageTest::main' );
}

/**
 * Test helper.
 */
require_once dirname( __FILE__ ) . '/../../TestHelper.php';

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
    /**
     *
     * @var str
     */
    private $_fileNameJpeg = '_files/1.jpg';

    public static function main()
    {
        $suite = new PHPUnit_Framework_TestSuite( __CLASS__ );
        $result = PHPUnit_TextUI_TestRunner::run( $suite );
    }


    /**
     * @return
     */
    public function testCanLoadJpeg()
    {
        $driver = new Zend_Image_Driver_Gd();

        $driver->load( $this->_fileNameJpeg );
        
        $imageSize = getimagesize( $this->_fileNameJpeg );

        $this->assertEquals(
            array( $imageSize[0], $imageSize[1] ), 
            $driver->getSize()
        );
    }
 
    public function testCanResize()
    {
//        $this->markTestIncomlete(); 
    }
}

if( PHPUnit_MAIN_METHOD == 'Zend_ImageTest::main' ) {
    Zend_ImageTest::main();
}
