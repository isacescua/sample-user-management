<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 6:09 PM
 */

namespace TestEndava\Domain\Service;

use Endava\Domain\Model\User;
use Endava\Domain\Service\UserService;
use Endava\Domain\ValueObject\CreateUserRequestObject;
use Endava\Domain\ValueObject\UpdateUserRequestObject;
use Endava\Domain\ValueObject\UserName;
use Endava\Infrastructure\Factory\UserFactory;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;
use Endava\Infrastructure\Persistence\InMemory\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class UserServiceTest extends TestCase
{

    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const SECOND_USER_NAME = 'Isacescu';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const USER_PASSWORD = 'myPassword';

    public function test__construct()
    {
        $userService = new UserService(new InMemoryUserRepository(), new UserFactory());
        $this->assertInstanceOf(UserService::class, $userService);
    }

    public function testRegister()
    {

        $requestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userService = new UserService(new InMemoryUserRepository(), new UserFactory());
        $user = $userService->register($requestObject);

        $this->assertInstanceOf(User::class, $user);
    }

    public function testUpdate()
    {
        $createRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userService = new UserService(new InMemoryUserRepository(), new UserFactory());
        $user = $userService->register($createRequestObject);

        $updateRequestObject = new UpdateUserRequestObject(
            $user->getUserId(),
            self::SECOND_USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userService->update($updateRequestObject);

        $user = $userService->getUserFromId((string)$user->getUserId());

        $this->assertTrue($user->getUserName()->equals(new UserName(self::SECOND_USER_NAME)));
    }

    /**
     * @expectedException Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException
     */
    public function testDelete()
    {

        $createRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userService = new UserService(new InMemoryUserRepository(), new UserFactory());
        $user = $userService->register($createRequestObject);

        $userService->delete((string)$user->getUserId());

        $user = $userService->getUserFromId((string)$user->getUserId());
    }

    public function testGetUserFromId()
    {
        $createRequestObject = new CreateUserRequestObject(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $userService = new UserService(new InMemoryUserRepository(), new UserFactory());
        $user = $userService->register($createRequestObject);
        $newUser = $userService->getUserFromId((string)$user->getUserId());

        $this->assertInstanceOf(User::class, $newUser);
    }
}
