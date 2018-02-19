<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 6:02 PM
 */

namespace TestEndava\Infrastructure\Persistence\InMemory;

use Endava\Domain\Model\User;
use Endava\Domain\ValueObject\UserEmail;
use Endava\Domain\ValueObject\UserId;
use Endava\Domain\ValueObject\UserName;
use Endava\Domain\ValueObject\UserPassword;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;
use Endava\Infrastructure\Persistence\InMemory\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class InMemoryUserRepositoryTest extends TestCase
{

    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const SECOND_EMAIL = 'isacescuA@endava.com';
    const USER_PASSWORD = 'myPassword';

    public function test__construct()
    {
        $repository = new InMemoryUserRepository();
        $this->assertInstanceOf(InMemoryUserRepository::class, $repository);
    }

    /**
     * @throws \Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException
     */
    public function testUpdate()
    {
        $user = new User(
            UserId::fromString(self::USER_ID),
            new UserName(self::USER_NAME),
            new UserEmail(self::USER_EMAIL),
            new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy())
        );

        $repository = new InMemoryUserRepository();
        $repository->add($user);

        $user->setUserEmail(self::SECOND_EMAIL);

        $repository->update($user);
        $newUser = $repository->userOfId(UserId::fromString(self::USER_ID));

        $this->assertTrue($user->getUserEmail()->equals($newUser->getUserEmail()));

    }

    /**
     * @throws UserNotFoundException
     */
    public function testAdd()
    {

        $user = new User(
            UserId::fromString(self::USER_ID),
            new UserName(self::USER_NAME),
            new UserEmail(self::USER_EMAIL),
            new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy())
        );

        $repository = new InMemoryUserRepository();
        $repository->add($user);

        $newUser = $repository->userOfId(UserId::fromString(self::USER_ID));

        $this->assertEquals(serialize($user), serialize($newUser));

    }

    /**
     * @expectedException \Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException
     */
    public function testRemove()
    {
        $user = new User(
            UserId::fromString(self::USER_ID),
            new UserName(self::USER_NAME),
            new UserEmail(self::USER_EMAIL),
            new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy())
        );

        $repository = new InMemoryUserRepository();
        $repository->add($user);

        $repository->remove($user);

        $newUser = $repository->userOfId(UserId::fromString(self::USER_ID));

    }

    public function testUserOfId()
    {
        $user = new User(
            UserId::fromString(self::USER_ID),
            new UserName(self::USER_NAME),
            new UserEmail(self::USER_EMAIL),
            new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy())
        );

        $repository = new InMemoryUserRepository();
        $repository->add($user);

        $newUser = $repository->userOfId(UserId::fromString(self::USER_ID));

        $this->assertEquals(serialize($user), serialize($newUser));
    }

    public function testNextIdentity()
    {
        $repository = new InMemoryUserRepository();
        $userId = $repository->nextIdentity();
        $this->assertInstanceOf(UserId::class, $userId);
    }
}
