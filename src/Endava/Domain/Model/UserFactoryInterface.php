<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:35 AM
 */

namespace Endava\Domain\Model;


use Endava\Domain\ValueObject\CreateUserRequestObject;
use Endava\Domain\ValueObject\UpdateUserRequestObject;

/**
 * Factories help in decoupling the client from knowing how to build complex objects and Aggregates.
 * You could use them in order to create entire Aggregates as an entire piece, enforcing their invariants.
 *
 * Interface UserFactoryInterface
 * @package Endava\Domain\Model
 */
interface UserFactoryInterface
{
    /**
     * @param CreateUserRequestObject $requestObject
     * @return User
     */
    public function createFromCreateRequest(CreateUserRequestObject $requestObject);
    public function createFromUpdateRequest(UpdateUserRequestObject $requestObject);
}