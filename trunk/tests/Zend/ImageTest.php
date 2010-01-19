<?php

/**
 * Zend Image
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category   Zend
 * @package    Zend_Image
 * @author     Stanislav Seletskiy <s.seletskiy@gmail.com>
 * @author     Leonid Shagabutdinov <leonid@shagabutdinov.com>
 * @copyright  Copyright (c) 2010
 * @license    http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version    $Id: $
 */

/**
 * For single test run.
 */
if ( ! defined( 'PHPUnit_MAIN_METHOD' ) ) {
    define( 'PHPUnit_MAIN_METHOD', 'Zend_ImageTest::main' );
}

/**
 * Test helper.
 */
require_once dirname( __FILE__ ) . '/../TestHelper.php';

/**
 * @see Zend_Image
 */
require_once 'Zend/Image.php';

/**
 * @category    Zend
 * @package     Zend_Image
 * @subpackage  UnitTests
 * @author      Seletskiy Stanislav <s.seletskiy@office.ngs.ru>
 * @author      Leonid Shagabutdinov <leonid@shagabutdinov.com>
 * @copyright   2010 NGS
 */
class Zend_ImageTest extends PHPUnit_Framework_Testcase
{
    public static function main()
    {
        $suite = new PHPUnit_Framework_TestSuite( __CLASS__ );
        $result = PHPUnit_TextUI_TestRunner::run( $suite );
    }

    public function setUp() {}
    public function tearDown() {}

    public function testLoad()
    {
        $driverMock = $this->getMock( 'Zend_Image_Driver_Interface' );
        $driverMock->expects( $this->once() )->method( 'load' )
            ->with( '1.jpg' );

        $i = new Zend_Image( '1.jpg', $driverMock );
    }
}

if ( PHPUnit_MAIN_METHOD == 'Zend_ImageTest::main' ) {
    Zend_ImageTest::main();
}
