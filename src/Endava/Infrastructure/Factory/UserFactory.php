<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 10:04 AM
 */

namespace Endava\Infrastructure\Factory;


use Endava\Domain\Model\User;
use Endava\Domain\Model\UserFactoryInterface;
use Endava\Domain\ValueObject\CreateUserRequestObject;
use Endava\Domain\ValueObject\UpdateUserRequestObject;
use Endava\Domain\ValueObject\UserEmail;
use Endava\Domain\ValueObject\UserId;
use Endava\Domain\ValueObject\UserName;
use Endava\Domain\ValueObject\UserPassword;

/**
 *
 * Class UserFactory
 * @package Endava\Infrastructure\Factory
 */
class UserFactory implements UserFactoryInterface
{
    /**
     * @param CreateUserRequestObject $requestObject
     * @return User
     */
    public function createFromCreateRequest(CreateUserRequestObject $requestObject)
    {

        $user = new User(
                UserId::getNext(),
                new UserName($requestObject->getUserName()),
                new UserEmail($requestObject->getUserEmail()),
                new UserPassword($requestObject->getUserPlainPassword(), $requestObject->getEncodingStrategy())
            );

        return $user;

    }

    /**
     * @param UpdateUserRequestObject $requestObject
     * @return User
     */
    public function createFromUpdateRequest(UpdateUserRequestObject $requestObject){

        $user = new User(
            UserId::fromString($requestObject->getUserId()),
            new UserName($requestObject->getUserName()),
            new UserEmail($requestObject->getUserEmail()),
            new UserPassword($requestObject->getUserPlainPassword(),$requestObject->getEncodingStrategy())
        );

        return $user;
    }


}