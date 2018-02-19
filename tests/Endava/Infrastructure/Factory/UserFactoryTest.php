<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 6:04 PM
 */

namespace TestEndava\Infrastructure\Factory;

use Endava\Domain\Model\User;
use Endava\Domain\ValueObject\CreateUserRequestObject;
use Endava\Domain\ValueObject\UpdateUserRequestObject;
use Endava\Domain\ValueObject\UserName;
use Endava\Infrastructure\Factory\UserFactory;
use PHPUnit\Framework\TestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class UserFactoryTest extends TestCase
{
    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const USER_PASSWORD = 'myPassword';

    const SECOND_USER_NAME = 'Mihai';

    public function testCreateFromCreateRequest()
    {
        $createUserRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userFactory = new UserFactory();
        $user = $userFactory->createFromCreateRequest($createUserRequestObject);

        $this->assertInstanceOf(User::class, $user);
    }

    public function testCreateFromUpdateRequest()
    {
        $createUserRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userFactory = new UserFactory();
        $user = $userFactory->createFromCreateRequest($createUserRequestObject);

        $updateUserRequestObject = new UpdateUserRequestObject(
            $user->getUserId(),
            self::SECOND_USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userUpdated = $userFactory->createFromUpdateRequest($updateUserRequestObject);

        $this->assertTrue($userUpdated->getUserName()->equals(new UserName(self::SECOND_USER_NAME)));
    }
}
