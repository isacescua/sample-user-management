<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:51 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\UpdateUserRequestObject;
use TestEndava\AbstractTestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class UpdateUserRequestObjectTest extends AbstractTestCase
{
    public function test__construct()
    {
        $updateUserRequestObject = $this->getUpdateUserRequestObject();
        $this->assertInstanceOf(UpdateUserRequestObject::class, $updateUserRequestObject);
    }

    public function testGetUserName()
    {
        $updateUserRequestObject = $this->getUpdateUserRequestObject();
        $this->assertEquals($updateUserRequestObject->getUserName(), self::SECOND_USER_NAME);
    }

    public function testGetUserEmail()
    {
        $updateUserRequestObject = $this->getUpdateUserRequestObject();
        $this->assertEquals($updateUserRequestObject->getUserEmail(), self::SECOND_USER_EMAIL);
    }

    public function testGetUserPlainPassword()
    {
        $updateUserRequestObject = $this->getUpdateUserRequestObject();
        $this->assertEquals($updateUserRequestObject->getUserPlainPassword(), self::SECOND_USER_PASSWORD);
    }

    public function testGetEncodingStrategy()
    {
        $updateUserRequestObject = $this->getUpdateUserRequestObject();
        $this->assertInstanceOf(MockPasswordEncodingStrategy::class, $updateUserRequestObject->getEncodingStrategy());
    }

    public function testGetUserId()
    {
        $updateUserRequestObject = $this->getUpdateUserRequestObject();
        $this->assertEquals($updateUserRequestObject->getUserId(), self::USER_ID);
    }
}
