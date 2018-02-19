<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 3:45 PM
 */

namespace Endava\Domain\Service;


use Endava\Domain\ValueObject\CreateUserRequestObject;
use Endava\Domain\ValueObject\UpdateUserRequestObject;

interface UserServiceInterface
{
    public function register(CreateUserRequestObject $requestObject);
    public function update(UpdateUserRequestObject $requestObject);
    public function delete($userId);
    public function getUserFromId($userId);
}