<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 3:46 PM
 */

namespace TestEndava\Domain\Service;

class MockUserService implements \Endava\Domain\Service\UserServiceInterface
{
    public function register(\Endava\Domain\ValueObject\CreateUserRequestObject $requestObject)
    {
        // TODO: Implement register() method.
    }

    public function update(\Endava\Domain\ValueObject\UpdateUserRequestObject $requestObject)
    {
        // TODO: Implement update() method.
    }

    public function delete($userId)
    {
        // TODO: Implement delete() method.
    }

    public function getUserFromId($userId)
    {
        // TODO: Implement getUserFromId() method.
    }

}