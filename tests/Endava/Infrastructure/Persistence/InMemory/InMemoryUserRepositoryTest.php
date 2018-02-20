<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 6:02 PM
 */

namespace TestEndava\Infrastructure\Persistence\InMemory;

use Endava\Domain\Model\UserRepositoryInterface;
use Endava\Domain\ValueObject\UserId;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;
use Endava\Infrastructure\Persistence\InMemory\InMemoryUserRepository;
use TestEndava\AbstractTestCase;

class InMemoryUserRepositoryTest extends AbstractTestCase
{
    /** @var UserRepositoryInterface $repository */
    private $repository;

    public function setUp()
    {
        parent::setUp();
        $this->repository = new InMemoryUserRepository();
    }

    public function test__construct()
    {
        $this->assertInstanceOf(InMemoryUserRepository::class, $this->repository);
    }

    public function testUpdate()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->repository->add($user);
        $user->setUserEmail(self::SECOND_USER_EMAIL);
        $this->repository->update($user);
        try {
            $newUser = $this->repository->userOfId(UserId::fromString(self::USER_ID));
        } catch (UserNotFoundException $exception) {
            return false;
        }
        $this->assertTrue($user->getUserEmail()->equals($newUser->getUserEmail()));
    }

    public function testAdd()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->repository->add($user);
        try {
            $newUser = $this->repository->userOfId(UserId::fromString(self::USER_ID));
        } catch (UserNotFoundException $exception) {
            return false;
        }
        $this->assertEquals(serialize($user), serialize($newUser));
    }

    /**
     * @expectedException \Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException
     */
    public function testRemove()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->repository->add($user);
        $this->repository->remove($user);
        $this->repository->userOfId(UserId::fromString(self::USER_ID));
    }

    public function testUserOfId()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->repository->add($user);
        try {
            $newUser = $this->repository->userOfId(UserId::fromString(self::USER_ID));
        } catch (UserNotFoundException $exception) {
            return false;
        }
        $this->assertEquals(serialize($user), serialize($newUser));
    }

    public function testNextIdentity()
    {
        $userId = $this->repository->nextIdentity();
        $this->assertInstanceOf(UserId::class, $userId);
    }
}
