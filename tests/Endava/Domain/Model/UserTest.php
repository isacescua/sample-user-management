<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:02 PM
 */

namespace TestEndava\Domain\Model;

use Endava\Domain\Model\User;
use Endava\Domain\ValueObject\UserEmail;
use Endava\Domain\ValueObject\UserId;
use Endava\Domain\ValueObject\UserName;
use Endava\Domain\ValueObject\UserPassword;
use TestEndava\AbstractTestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class UserTest extends AbstractTestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(User::class, $this->createDefaultUser());
    }

    public function testGetUserId()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->assertTrue(
            $user->getUserId()->equals(
                UserId::fromString(self::USER_ID)
            )
        );
    }

    public function testGetUserName()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->assertTrue(
            $user->getUserName()->equals(
                new UserName(self::USER_NAME)
            )
        );
    }

    public function testGetUserEmail()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->assertTrue(
            $user->getUserEmail()->equals(
                new UserEmail(self::USER_EMAIL)
            )
        );
    }

    public function testSetUserName()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $user->setUserName(self::SECOND_USER_NAME);
        $this->assertTrue(
            $user->getUserName()->equals(
                new UserName(self::SECOND_USER_NAME)
            )
        );
    }

    public function testSetUserEmail()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $user->setUserEmail(self::SECOND_USER_EMAIL);
        $this->assertTrue(
            $user->getUserEmail()->equals(
                new UserEmail(self::SECOND_USER_EMAIL)
            )
        );
    }

    public function testSetUserPassword()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $user->setUserPassword(self::SECOND_USER_PASSWORD);
        $this->assertTrue(
            $user->getUserPassword()->equals(
                new UserPassword(self::SECOND_USER_PASSWORD, new MockPasswordEncodingStrategy())
            )
        );
    }

    public function testToArray()
    {
        $user      = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $userArray = $user->toArray();
        $this->assertEquals((array)$user, $userArray);
    }
}
