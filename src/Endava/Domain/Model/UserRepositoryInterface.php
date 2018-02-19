<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:06 AM
 */

namespace Endava\Domain\Model;


use Endava\Domain\ValueObject\UserId;

/**
 *
 * The mechanism between the domain and data mapping layers, acting like an in-memory domain object collection.
 *
 * Interface UserRepositoryInterface
 * @package Endava\Domain\Model
 */
interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function update(User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function remove(User $user);

    /**
     * @param UserId $userId
     * @return User
     */
    public function userOfId(UserId $userId);

    /**
     * @return UserId
     */
    public function nextIdentity();

}