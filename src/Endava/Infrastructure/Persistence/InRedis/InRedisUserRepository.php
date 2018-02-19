<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 12:53 PM
 */

namespace Endava\Infrastructure\Persistence\InRedis;


use Endava\Domain\Model\User;
use Endava\Domain\Model\UserRepositoryInterface;
use Endava\Domain\ValueObject\UserId;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;
use Predis\ClientInterface;

class InRedisUserRepository implements UserRepositoryInterface
{
    private $client;

    const USER_HSET = 'USERS';

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param User $user
     * @return mixed|void
     */
    public function update(User $user)
    {
        $this->client->hset(self::USER_HSET, (string) $user->getUserId(), serialize($user));
    }


    /**
     * @param User $user
     * @return mixed|void
     */
    public function add(User $user)
    {

        $this->client->hset(self::USER_HSET, (string) $user->getUserId(), serialize($user));
    }

    /**
     * @param User $user
     * @return mixed|void
     */
    public function remove(User $user)
    {
        $this->client->hdel(self::USER_HSET, (string) $user->getUserId());
    }

    /**
     * @param UserId $userId
     * @return User
     * @throws UserNotFoundException
     */
    public function userOfId(UserId $userId)
    {
        $resultFromRedis = $this->client->hget(self::USER_HSET, (string) $userId);

        if (empty($resultFromRedis)) {
            throw new UserNotFoundException();
        }

        return(unserialize($resultFromRedis));

    }

    /**
     * @return UserId
     */
    public function nextIdentity()
    {
        return UserId::getNext();
    }

}