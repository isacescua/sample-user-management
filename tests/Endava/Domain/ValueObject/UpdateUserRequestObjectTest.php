<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:51 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\UpdateUserRequestObject;
use PHPUnit\Framework\TestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class UpdateUserRequestObjectTest extends TestCase
{

    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const USER_PASSWORD = 'myPassword';

    public function test__construct()
    {
        $updateUserRequestObject = new UpdateUserRequestObject(
            self::USER_ID,
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertInstanceOf(UpdateUserRequestObject::class, $updateUserRequestObject);
    }

    public function testGetUserName()
    {
        $updateUserRequestObject = new UpdateUserRequestObject(
            self::USER_ID,
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertEquals($updateUserRequestObject->getUserName(), self::USER_NAME);
    }

    public function testGetUserEmail()
    {
        $updateUserRequestObject = new UpdateUserRequestObject(
            self::USER_ID,
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertEquals($updateUserRequestObject->getUserEmail(), self::USER_EMAIL);
    }

    public function testGetUserPlainPassword()
    {
        $updateUserRequestObject = new UpdateUserRequestObject(
            self::USER_ID,
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertEquals($updateUserRequestObject->getUserPlainPassword(), self::USER_PASSWORD);
    }

    public function testGetEncodingStrategy()
    {
        $updateUserRequestObject = new UpdateUserRequestObject(
            self::USER_ID,
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertInstanceOf(MockPasswordEncodingStrategy::class, $updateUserRequestObject->getEncodingStrategy());
    }

    public function testGetUserId()
    {
        $updateUserRequestObject = new UpdateUserRequestObject(
            self::USER_ID,
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertEquals($updateUserRequestObject->getUserId(), self::USER_ID);
    }
}
