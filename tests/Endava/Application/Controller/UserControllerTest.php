<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/19/2018
 * Time: 8:06 AM
 */

namespace TestEndava\Application\Controller;

use Endava\Application\Controller\UserController;
use Endava\Domain\Model\User;
use Endava\Domain\Model\UserRepositoryInterface;
use Endava\Domain\Service\UserService;
use Endava\Domain\Service\UserServiceInterface;
use Endava\Domain\ValueObject\UserId;
use Endava\Domain\ValueObject\UserName;
use Endava\Infrastructure\Factory\UserFactory;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;
use Endava\Infrastructure\Persistence\InMemory\InMemoryUserRepository;
use TestEndava\AbstractTestCase;

class UserControllerTest extends AbstractTestCase
{
    /** @var UserRepositoryInterface $userRepository */
    private $userRepository;
    /** @var UserService $userService */
    private $userService;
    /** @var UserController $userController */
    private $userController;

    public function setUp()
    {
        parent::setUp();
        $this->userRepository = new InMemoryUserRepository();
        $this->userService    = new UserService($this->userRepository, new UserFactory());
        $this->userController = new UserController($this->userService);
    }

    public function test__construct()
    {
        $this->assertInstanceOf(UserServiceInterface::class, $this->userController->getService());
    }

    public function testPostUser()
    {
        $userCreateRequest = $this->getCreateUserRequest();
        $userId            = $this->userController->postUser($userCreateRequest);

        try {
            $userModel = $this->userRepository->userOfId(UserId::fromString($userId));
            $this->assertInstanceOf(User::class, $userModel);
        } catch (UserNotFoundException $exception) {
            return false;
        }
    }

    public function testPutUser()
    {
        $userCreateRequest = $this->getCreateUserRequest();
        $userId            = $this->userController->postUser($userCreateRequest);
        $userUpdateRequest = $this->getUpdateUserRequest($userId);
        $this->userController->putUser($userUpdateRequest);

        try {
            /** @var User $userModel */
            $userModel = $this->userRepository->userOfId(UserId::fromString($userId));
            $this->assertTrue($userModel->getUserName()->equals(new UserName(self::SECOND_USER_NAME)));
        } catch (UserNotFoundException $exception) {
            return false;
        }
    }

    /**
     * @expectedException Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException
     * @throws UserNotFoundException
     */
    public function testDeleteUser()
    {
        $userCreateRequest = $this->getCreateUserRequest();
        $userId            = $this->userController->postUser($userCreateRequest);
        $this->userController->deleteUser($userId);
        $this->userRepository->userOfId(UserId::fromString($userId));
    }

    public function testGetUser()
    {
        $userCreateRequest = $this->getCreateUserRequest();
        $userId            = $this->userController->postUser($userCreateRequest);
        $userModel         = $this->userController->getUser($userId);
        $this->assertInstanceOf(User::class, $userModel);
    }

    public function testGetService()
    {
        $this->assertInstanceOf(UserService::class, $this->userController->getService());
    }
}
