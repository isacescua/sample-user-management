<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:53 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\UserEmail;
use TestEndava\AbstractTestCase;

class UserEmailTest extends AbstractTestCase
{

    public function test__construct()
    {
        $userEmail = new UserEmail(self::USER_EMAIL);
        $this->assertInstanceOf(UserEmail::class, $userEmail);
    }

    public function testUpdateEmail()
    {
        $userEmail    = new UserEmail(self::USER_EMAIL);
        $newUserEmail = $userEmail->updateEmail(self::SECOND_USER_EMAIL);
        $this->assertTrue($newUserEmail->equals(new UserEmail(self::SECOND_USER_EMAIL)));
    }

    public function testGetUserEmail()
    {
        $userEmail = new UserEmail(self::USER_EMAIL);
        $this->assertEquals($userEmail->getUserEmail(), self::USER_EMAIL);
    }

    public function testEquals()
    {
        $userEmail       = new UserEmail(self::USER_EMAIL);
        $secondUserEmail = new UserEmail(self::USER_EMAIL);
        $this->assertTrue($userEmail->equals($secondUserEmail));

    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserEmailNotEmpty()
    {
        new UserEmail(self::EMPTY_EMAIL);
    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserEmailIsValid()
    {
        new UserEmail(self::INVALID_EMAIL_ADDRESS);
    }
}
