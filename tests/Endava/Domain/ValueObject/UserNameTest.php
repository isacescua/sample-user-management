<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:54 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\UserName;
use PHPUnit\Framework\TestCase;

class UserNameTest extends TestCase
{

    const USER_NAME ='andrei';
    const SECOND_USER_NAME = 'isacescu';
    const EMPTY_USER_NAME = '';

    public function test__construct()
    {
        $userName = new UserName(self::USER_NAME);
        $this->assertInstanceOf(UserName::class, $userName);
    }

    public function testUpdateUserName()
    {
        $userName = new UserName(self::USER_NAME);
        $newUserName = $userName->updateUserName(self::SECOND_USER_NAME);
        $this->assertEquals($newUserName->getUserName(), self::SECOND_USER_NAME);
    }

    public function testGetUserName()
    {
        $userName = new UserName(self::USER_NAME);
        $this->assertEquals($userName->getUserName(), self::USER_NAME);
    }

    public function testEquals()
    {
        $userName = new UserName(self::USER_NAME);
        $newUserName = new UserName(self::USER_NAME);
        $this->assertTrue($userName->equals($newUserName));
    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserNameNotEmpty(){
        $userName = new UserName(self::EMPTY_USER_NAME);
    }

}
