<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:54 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\UserPassword;
use TestEndava\AbstractTestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class UserPasswordTest extends AbstractTestCase
{
    public function test__construct()
    {
        $userPassword = new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy());
        $this->assertInstanceOf(UserPassword::class, $userPassword);
    }

    public function testUpdatePassword()
    {
        $userPassword = new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy());
        $newPassword  = $userPassword->updatePassword(self::SECOND_USER_PASSWORD);
        $this->assertTrue($newPassword->equals(new UserPassword(self::SECOND_USER_PASSWORD, new MockPasswordEncodingStrategy())));
    }

    public function testGetUserPassword()
    {
        $userPassword       = new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy());
        $secondUserPassword = new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy());
        $this->assertNotEmpty($userPassword->getUserPassword());
        $this->assertEquals($userPassword->getUserPassword(), $secondUserPassword->getUserPassword());
    }

    public function testEquals()
    {
        $userPassword = new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy());
        $newPassword  = new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy());
        $this->assertTrue($userPassword->equals($newPassword));
    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserPasswordNotEmpty()
    {
        new UserPassword(self::EMPTY_PASSWORD, new MockPasswordEncodingStrategy());
    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserPasswordIsMinimumEightChars()
    {
        new UserPassword(self::SMALL_PASSWORD, new MockPasswordEncodingStrategy());
    }
}
