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
use Endava\Domain\ValueObject\UserName;
use Endava\Infrastructure\Factory\UserFactory;
use Endava\Infrastructure\Persistence\InMemory\InMemoryUserRepository;
use TestEndava\AbstractTestCase;

class UserServiceTest extends AbstractTestCase
{

    /** @var UserService $userService */
    private $userService;

    public function setUp()
    {
        parent::setUp();
        $this->userService = new UserService(new InMemoryUserRepository(), new UserFactory());
    }

    public function test__construct()
    {
        $this->assertInstanceOf(UserService::class, $this->userService);
    }

    public function testRegister()
    {
        $requestObject = $this->getCreateUserRequestObject();
        $user          = $this->userService->register($requestObject);
        $this->assertInstanceOf(User::class, $user);
    }

    public function testUpdate()
    {
        $createRequestObject = $this->getCreateUserRequestObject();
        $user                = $this->userService->register($createRequestObject);
        $updateRequestObject = $this->getUpdateUserRequestObject($user->getUserId()->getUserId());
        $this->userService->update($updateRequestObject);
        $user = $this->userService->getUserFromId((string)$user->getUserId());
        $this->assertTrue($user->getUserName()->equals(new UserName(self::SECOND_USER_NAME)));
    }

    /**
     * @expectedException Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException
     */
    public function testDelete()
    {

        $createRequestObject = $this->getCreateUserRequestObject();
        $user                = $this->userService->register($createRequestObject);
        $this->userService->delete((string)$user->getUserId());
        $this->userService->getUserFromId((string)$user->getUserId());
    }

    public function testGetUserFromId()
    {
        $createRequestObject = $this->getCreateUserRequestObject();
        $user                = $this->userService->register($createRequestObject);
        $newUser             = $this->userService->getUserFromId((string)$user->getUserId());
        $this->assertInstanceOf(User::class, $newUser);
    }

}
