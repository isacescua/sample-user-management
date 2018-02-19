<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 6:07 PM
 */

namespace TestEndava\Infrastructure\PasswordEncodingStrategies;

use Endava\Infrastructure\PasswordEncodingStrategies\Md5PasswordEncodingStrategy;
use PHPUnit\Framework\TestCase;

class Md5PasswordEncodingStrategyTest extends TestCase
{

    const PASSWORD = 'test';

    public function testEncodePasswordAndReturnValue()
    {
        $password = new Md5PasswordEncodingStrategy();
        $encodedPassword = $password->encodePasswordAndReturnValue(self::PASSWORD);
        $this->assertEquals(md5(self::PASSWORD), $encodedPassword);
    }
}
