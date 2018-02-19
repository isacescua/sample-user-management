<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/19/2018
 * Time: 8:06 AM
 */

namespace TestEndava\Application\Controller;

use Endava\Application\Controller\UserController;
use Endava\Application\Request\CreateUserRequest;
use Endava\Application\Request\UpdateUserRequest;
use Endava\Domain\Model\User;
use Endava\Domain\Service\UserService;
use Endava\Domain\Service\UserServiceInterface;
use Endava\Domain\ValueObject\UserId;
use Endava\Domain\ValueObject\UserName;
use Endava\Infrastructure\Factory\UserFactory;
use Endava\Infrastructure\PasswordEncodingStrategies\Md5PasswordEncodingStrategy;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;
use Endava\Infrastructure\Persistence\InMemory\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;
use TestEndava\Domain\Service\MockUserService;

class UserControllerTest extends TestCase
{

    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const USER_PASSWORD = 'myPassword';

    const SECOND_USER_NAME = 'Mihai';

    public function test__construct()
    {
        $mockUserService = new MockUserService();
        $userController  = new UserController($mockUserService);
        $this->assertInstanceOf(UserServiceInterface::class, $userController->getService());
    }

    public function testPostUser()
    {
        $userRepository = new InMemoryUserRepository();
        $userService    = new UserService($userRepository, new UserFactory());
        $userController = new UserController($userService);
        $userCreateRequest    = new CreateUserRequest(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new Md5PasswordEncodingStrategy()
        );

        $userId = $userController->postUser($userCreateRequest);
        try {
            $userModel = $userRepository->userOfId(UserId::fromString($userId));
            $this->assertInstanceOf(User::class, $userModel);
        } catch (UserNotFoundException $exception) {
            return false;
        }

    }

    public function testPutUser()
    {
        $userRepository = new InMemoryUserRepository();
        $userService    = new UserService($userRepository, new UserFactory());
        $userController = new UserController($userService);
        $userCreateRequest    = new CreateUserRequest(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new Md5PasswordEncodingStrategy()
        );

        $userId = $userController->postUser($userCreateRequest);

        $userUpdateRequest = new UpdateUserRequest(
            $userId,
            self::SECOND_USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new Md5PasswordEncodingStrategy()
        );

        $userController->putUser($userUpdateRequest);
        try {
            /** @var User $userModel */
            $userModel = $userRepository->userOfId(UserId::fromString($userId));

            $this->assertTrue($userModel->getUserName()->equals(new UserName(self::SECOND_USER_NAME)));

        } catch (UserNotFoundException $exception) {
            return false;
        }
    }

    /**
     * @expectedException Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException
     */
    public function testDeleteUser()
    {

        $userRepository = new InMemoryUserRepository();
        $userService    = new UserService($userRepository, new UserFactory());
        $userController = new UserController($userService);
        $userCreateRequest    = new CreateUserRequest(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new Md5PasswordEncodingStrategy()
        );

        $userId = $userController->postUser($userCreateRequest);

        $userController->deleteUser($userId);

        $userRepository->userOfId(UserId::fromString($userId));
    }

    public function testGetUser()
    {
        $userRepository = new InMemoryUserRepository();
        $userService    = new UserService($userRepository, new UserFactory());
        $userController = new UserController($userService);
        $userCreateRequest    = new CreateUserRequest(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new Md5PasswordEncodingStrategy()
        );

        $userId = $userController->postUser($userCreateRequest);

        $userModel = $userController->getUser($userId);
        $this->assertInstanceOf(User::class, $userModel);
    }

    public function testGetService()
    {
        $mockUserService = new MockUserService();
        $userController  = new UserController($mockUserService);
        $this->assertInstanceOf(MockUserService::class, $userController->getService());
    }
}
