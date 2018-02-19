<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:45 AM
 */

namespace Endava\Infrastructure\Persistence\InMemory;


use Endava\Domain\Model\User;
use Endava\Domain\Model\UserRepositoryInterface;
use Endava\Domain\ValueObject\UserId;
use Endava\Infrastructure\Persistence\Exceptions\UserNotFoundException;

class InMemoryUserRepository implements UserRepositoryInterface
{

    private $users = [];

    /**
     * @param User $user
     * @return mixed|void
     */
    public function add(User $user)
    {
        $this->users[(string) $user->getUserId()] = $user;
    }

    /**
     * @param User $user
     * @return mixed|void
     */
    public function update(User $user){
        $this->users[(string) $user->getUserId()] = $user;
    }

    /**
     * @param User $user
     * @return mixed|void
     */
    public function remove(User $user)
    {
        unset($this->users[(string) $user->getUserId()]);
    }

    /**
     * @param UserId $userId
     * @return mixed
     * @throws UserNotFoundException
     */
    public function userOfId(UserId $userId)
    {
        if (!isset($this->users[(string) $userId])) {
            throw new UserNotFoundException();
        }

        return $this->users[(string) $userId];
    }

    /**
     * @return UserId
     */
    public function nextIdentity()
    {
        return UserId::getNext();
    }

}