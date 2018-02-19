<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:54 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{

    const USER_ID = '10';
    const EMPTY_USER_ID = '';

    public function test__toString()
    {
        $userId = UserId::fromString(self::USER_ID);
        $this->assertEquals((string)$userId, self::USER_ID);
    }

    public function testFromString()
    {
        $userId = UserId::fromString(self::USER_ID);
        $this->assertInstanceOf(UserId::class, $userId);
    }

    public function testGetNext()
    {
        $userId = UserId::getNext();
        $this->assertNotEmpty($userId);
        $this->assertInstanceOf(UserId::class, $userId);
    }

    public function testGetUserId()
    {
        $userId = UserId::fromString(self::USER_ID);
        $this->assertEquals($userId->getUserId(), self::USER_ID);
    }

    public function testEquals()
    {
        $userId = UserId::fromString(self::USER_ID);
        $secondUserId = UserId::fromString(self::USER_ID);
        $this->assertTrue($userId->equals($secondUserId));

    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testAssertUserIdNotEmpty(){
        $userId = UserId::fromString(self::EMPTY_USER_ID);
    }
}
