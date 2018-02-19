<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:53 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\UserEmail;
use PHPUnit\Framework\TestCase;

class UserEmailTest extends TestCase
{

    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const SECOND_USER_EMAIL = 'isacescua@endava.com';
    const EMPTY_EMAIL = '';
    CONST INVALID_EMAIL_ADDRESS = 'invalid';

    public function test__construct()
    {
        $userEmail = new UserEmail(self::USER_EMAIL);

        $this->assertInstanceOf(UserEmail::class, $userEmail);
    }

    public function testUpdateEmail()
    {
        $userEmail = new UserEmail(self::USER_EMAIL);
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
        $userEmail = new UserEmail(self::USER_EMAIL);
        $secondUserEmail = new UserEmail(self::USER_EMAIL);
        $this->assertTrue($userEmail->equals($secondUserEmail));

    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserEmailNotEmpty(){
        $userEmail = new UserEmail(self::EMPTY_EMAIL);
    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserEmailIsValid(){
        $userEmail = new UserEmail(self::INVALID_EMAIL_ADDRESS);
    }
}
