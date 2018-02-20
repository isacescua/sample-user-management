<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:36 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\CreateUserRequestObject;
use TestEndava\AbstractTestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class CreateUserRequestObjectTest extends AbstractTestCase
{
    public function test__construct()
    {
        $createUserRequestObject = $this->getCreateUserRequestObject();
        $this->assertInstanceOf(CreateUserRequestObject::class, $createUserRequestObject);
    }

    public function testGetUserName()
    {
        $createUserRequestObject = $this->getCreateUserRequestObject();
        $this->assertEquals($createUserRequestObject->getUserName(), self::USER_NAME);
    }

    public function testGetUserEmail()
    {
        $createUserRequestObject = $this->getCreateUserRequestObject();
        $this->assertEquals($createUserRequestObject->getUserEmail(), self::USER_EMAIL);
    }

    public function testGetUserPlainPassword()
    {
        $createUserRequestObject = $this->getCreateUserRequestObject();
        $this->assertEquals($createUserRequestObject->getUserPlainPassword(), self::USER_PASSWORD);
    }

    public function testGetEncodingStrategy()
    {
        $createUserRequestObject = $this->getCreateUserRequestObject();
        $this->assertInstanceOf(MockPasswordEncodingStrategy::class, $createUserRequestObject->getEncodingStrategy());
    }
}
