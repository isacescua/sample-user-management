<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 5:45 PM
 */

namespace TestEndava\Infrastructure\Persistence\InRedis;

use Endava\Domain\Model\UserRepositoryInterface;
use Endava\Domain\ValueObject\UserId;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;
use Endava\Infrastructure\Persistence\InRedis\InRedisUserRepository;
use TestEndava\AbstractTestCase;

class InRedisUserRepositoryTest extends AbstractTestCase
{
    /** @var UserRepositoryInterface $repository */
    private $repository;

    public function setUp()
    {
        $this->repository = new InRedisUserRepository(new MockClient());
        parent::setUp();
    }

    public function test__construct()
    {
        $this->assertInstanceOf(InRedisUserRepository::class, $this->repository);
    }

    /**
     * @throws UserNotFoundException
     */
    public function testUpdate()
    {
        $user = $this->createDefaultUser(UserId::fromString(self::USER_ID));
        $this->repository->add($user);
        $user->setUserEmail(self::SECOND_USER_EMAIL);
        $this->repository->update($user);
        $newUser = $this->repository->userOfId(UserId::fromString(self::USER_ID));
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
        $userId     = $this->repository->nextIdentity();
        $this->assertInstanceOf(UserId::class, $userId);
    }

}
