<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:36 PM
 */

namespace TestEndava\Domain\ValueObject;

use Endava\Domain\ValueObject\CreateUserRequestObject;
use PHPUnit\Framework\TestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class CreateUserRequestObjectTest extends TestCase
{

    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const USER_PASSWORD = 'myPassword';

    public function test__construct()
    {
        $createUserRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertInstanceOf(CreateUserRequestObject::class, $createUserRequestObject);
    }

    public function testGetUserName()
    {
        $createUserRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertEquals($createUserRequestObject->getUserName(), self::USER_NAME);
    }

    public function testGetUserEmail()
    {
        $createUserRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertEquals($createUserRequestObject->getUserEmail(), self::USER_EMAIL);
    }

    public function testGetUserPlainPassword()
    {
        $createUserRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertEquals($createUserRequestObject->getUserPlainPassword(), self::USER_PASSWORD);
    }

    public function testGetEncodingStrategy()
    {
        $createUserRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $this->assertInstanceOf(MockPasswordEncodingStrategy::class, $createUserRequestObject->getEncodingStrategy());
    }
}
