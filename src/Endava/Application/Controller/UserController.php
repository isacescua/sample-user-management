<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 10:35 AM
 */

namespace Endava\Application\Controller;


use Endava\Application\Adapter\CreateUserRequestToObjectAdapter;
use Endava\Application\Adapter\UpdateUserRequestToObjectAdapter;
use Endava\Application\Request\CreateUserRequest;
use Endava\Application\Request\UpdateUserRequest;
use Endava\Domain\Service\UserService;
use Endava\Domain\Service\UserServiceInterface;

/**
 * Operates on scalar types, transforming them into domain types.
 *
 * Scalar types can be considered any type that is unknown to the domain
 * model. This includes primitive and types that do not belong to the
 * domain.
 *
 * Services of this kind do not contain any business rules nor domain
 * logic. They simply exist to coordinate, orchestrate and execute
 * operations that belong to the domain model
 *
 * Class UserController
 * @package Endava\Application\Controller
 */
class UserController
{
    /**
     * @var UserService
     */
    private $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }


    /**
     * @param CreateUserRequest $requestObject
     * @return string
     */
    public function postUser(CreateUserRequest $requestObject)
    {

        $user = $this->service->register(new CreateUserRequestToObjectAdapter($requestObject));
        return (string)$user->getUserId();

    }

    /**
     * @param UpdateUserRequest $requestObject
     */
    public function putUser(UpdateUserRequest $requestObject)
    {
        $this->service->update(new UpdateUserRequestToObjectAdapter($requestObject));
    }

    /**
     * @param $userId
     */
    public function deleteUser($userId)
    {
        $this->service->delete($userId);
    }

    /**
     * @param $userId
     * @return \Endava\Domain\Model\User
     */
    public function getUser($userId)
    {
        return $this->service->getUserFromId($userId);
    }

    /**
     * @return UserService
     */
    public function getService()
    {
        return $this->service;
    }
}