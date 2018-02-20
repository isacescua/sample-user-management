<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 6:07 PM
 */

namespace TestEndava\Infrastructure\PasswordEncodingStrategies;

use Endava\Infrastructure\PasswordEncodingStrategies\Md5PasswordEncodingStrategy;
use TestEndava\AbstractTestCase;

class Md5PasswordEncodingStrategyTest extends AbstractTestCase
{

    public function testEncodePasswordAndReturnValue()
    {
        $password        = new Md5PasswordEncodingStrategy();
        $encodedPassword = $password->encodePasswordAndReturnValue(self::USER_PASSWORD);
        $this->assertEquals(md5(self::USER_PASSWORD), $encodedPassword);
    }
}
