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
 * @subpackage UnitTests
 * @author     Stanislav Seletskiy <s.seletskiy@gmail.com>
 * @author     Leonid Shagabutdinov <leonid@shagabutdinov.com>
 * @copyright  Copyright (c) 2010
 * @license    http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version    $Id$
 */

if ( !defined( 'PHPUnit_MAIN_METHOD' )) {
    define( 'PHPUnit_MAIN_METHOD', 'Zend_Image_AllTests::main' );
}

require_once dirname( __FILE__ ) . '/../TestHelper.php';

require_once 'Zend/ImageTest.php';
require_once 'Zend/Image/TransformTest.php';


/**
 * @category   Zend
 * @package    Zend_Image
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2010
 * @license    http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Zend_Image_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run( self::suite() );
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite( 'Zend Image' );

        $suite->addTestSuite( 'Zend_ImageTest' );
        $suite->addTestSuite( 'Zend_Image_TransformTest' );

        return $suite;
    }
}

if ( PHPUnit_MAIN_METHOD == 'Zend_Image_AllTests::main' ) {
    Zend_Image_AllTests::main();
}
